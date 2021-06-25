<?php
class reporterDashboard
{
    public $currentRole;
    public $reporterName;
    public $reporterEmail;
    function __construct()
    {
        add_action("init", [$this, "getReporterUser"]);
        add_action("init", [$this,  "displayReporterName"]);
        add_shortcode("Reporter_Dashboard", [$this, "reporterDashboad_cb"]);
    }

    public function getReporterUser()
    {

        $this->currentRole = get_users(array('role__in' => array("reporter")));
    }

    public function displayReporterName()
    {
        foreach ($this->currentRole as $reporter) {
            $this->reporterName = $reporter->display_name;
            $this->reporterEmail = $reporter->user_email;
        }
    }
    public function reporterDashboad_cb()
    {
        ob_start();
        require IA_PLUGIN_DIR_ASSET . "/assets/html/reporterDashboard.html";
        return ob_get_clean();
    }
}
new reporterDashboard();
