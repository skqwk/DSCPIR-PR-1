<?php
function print_cmd($cmd) {
    $lines = array();
    exec($cmd, $lines);
    echo "<div class='box'><pre> > <b>".$cmd."</b></pre>";
    echo "<pre class='result'>".implode("\n", $lines)."</pre></div>";
}

function show_admin_info($commands) {
    foreach ($commands as $cmd) {
        print_cmd($cmd);
    }
}
?>