<?php

namespace App\Http\Controllers;

class ChannelController
{
    public function __invoke()
    {
        return view('channels.index');
    }
}
