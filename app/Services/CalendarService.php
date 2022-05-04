<?php

namespace App\Services;

use App\Models\Class_name_subject;
use App\Models\Schedule;

class CalendarService
{
    public function generateCalendarData($weekDays)
    {
        $calendarData = [];
        $timeRange = (new TimeService)->generateTimeRange(config('app.calendar.start_time'), config('app.calendar.end_time'));
        $lessons   = Schedule::with('class_name_subject')
           ->calendarByRoleOrClassId()
           ->get();

        foreach ($timeRange as $time)
        {
            $timeText = $time['start'] . ' - ' . $time['end'];
            $calendarData[$timeText] = [];

            foreach ($weekDays as $index => $day)
            {
                $lesson = $lessons->where('weekday', $index)->where('start_time', $time['start'])->first();

                if ($lesson)
                {
                    array_push($calendarData[$timeText], [
                        'class_name'   => $lesson->class_name_subject->class_name->name,
                        'subject_name' => $lesson->class_name_subject->subject->name,
                        'teacher_name' => $lesson->class_name_subject->user->name,
                        'teacher_surname' => $lesson->class_name_subject->user->surname,
                        'rowspan'      => $lesson->difference/45 ?? ''
                    ]);
                }
                else if (!$lessons->where('weekday', $index)->where('start_time', '<', $time['start'])->where('end_time', '>=', $time['end'])->count())
                {
                    array_push($calendarData[$timeText], 1);
                }
                else
                {
                    array_push($calendarData[$timeText], 0);
                }
            }
        }

        return $calendarData;
    }
}
