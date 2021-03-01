<?php

function getfolder(){
    return app() -> getLocale() === 'ar'?'css-rtl':'css';
}
