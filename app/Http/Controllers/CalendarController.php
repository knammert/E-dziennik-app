<?php

namespace App\Http\Controllers;

use App\Models\Class_name;
use Illuminate\Http\Request;
use App\Models\Class_name_subject;
use App\Services\CalendarService;

class CalendarController extends Controller
{
    public function index(CalendarService $calendarService)
    {
        $weekDays     = Class_name_subject::WEEK_DAYS;
        $calendarData = $calendarService->generateCalendarData($weekDays);
        $activities = Class_name::all();
        return view('adminPanel.calendar', compact('weekDays','calendarData','activities'));
    }
}
