<?php

class LayoutController {
    function m4_7d_layout(RequestData $rd) {
        if(isset($rd->query['no'])) {
            $page = $rd->query['no'];
            $title = "One";
        }
        else {
            $title = "Two";
            $page = 1;
        }
        if($page == 2){
            return view('examples.pages.m4_7d_page_2',['title' => $title]);
        }
        else {
            return view('examples.pages.m4_7d_page_1',['title' => $title]);
        }
    }
}