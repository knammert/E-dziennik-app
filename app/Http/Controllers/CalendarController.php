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
        $background_colors = array('#037bfc', '#fca503', '#b103fc', '#ed6d05', '#fc0356','#6B8E23','#008B8B');
        return view('adminPanel.calendar', compact('weekDays','calendarData','activities','background_colors'));
    }
}
