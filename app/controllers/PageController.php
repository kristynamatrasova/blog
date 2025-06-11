<?php
class PageController extends Controller {
    public function stat1() { //načte a zobrazí
        $this->view('pages/stat1'); //načítá odpovídající šablony
    }
    public function stat2() {
        $this->view('pages/stat2');
    }
    public function stat3() {
        $this->view('pages/stat3');
    }
    public function stat4() {
        $this->view('pages/stat4');
    }
}
