<?php
namespace Launch;

class PDFGenerator extends Generator
{
    /** inherit comment */
    public function getContent()
    {
        if (empty($this->response))
        {
            echo 'Could not get the launches information from Space X.' . PHP_EOL;
            return '';
        }

        $content = '
        <h2>Mission: '.$this->response['mission_name'].'</h2>
        <h5>Mission launch date(UTC) '.$this->response['launch_date_utc'].'</h5><br><br>';
        if ($this->response['launch_success'] === true)
        {
            $content .= '
        <h5>The launch was successful.</h5>';
        }
        if ($this->response['launch_success'] === false)
        {
            $content .= '
        <h5>The launch was not successful.</h5>';
        }
        $content .= '
        <h5>Launch site:</h5>
        <p>'.$this->response['launch_site']['site_name_long'].'</p>
        <h5>Used rocked:</h5>
        <p>The name of the rocket is '.$this->response['rocket']['rocket_name'].' with rocket type '.$this->response['rocket']['rocket_type'].'.</p>
        <h5>First stage booster of the rocket:</h5>';
        foreach ($this->response['rocket']['first_stage']['cores'] as $core)
        {
            $landingString = '';
            if (!empty($core['landing_vehicle']))
            {
                $landingString = ' and the core landed with landing vehicle '.$core['landing_vehicle'];
            }
            $content .= '
        <p>The core serial is '.$core['core_serial'].' which is flight number '.$core['flight'] .' of this core'.$landingString.'.</p>';
        }
        $content .= '
        <h5>Second stage of the rocket:</h5>
        <p>The second stage of the rocket has '.$this->response['rocket']['second_stage']['block'].' blocks.</p>';
        foreach ($this->response['rocket']['second_stage']['payloads'] as $payload)
        {
            $content .= '
        <p>A payload '.$payload['payload_id'].' which is type '.$payload['payload_type'].' with weight '.$payload['payload_mass_kg'].'kg was manufactured from '.$payload['manufacturer'].' ('.$payload['nationality'].').</p>';
        }
        $content .= '
        <h5>Details of the launch:</h5>
        <p>'.$this->response['details'].'</p>
        <h5>External links:</h5>';
        if (!empty($this->response['links']['mission_patch']))
        {
            $content .= '
        <a href="'.$this->response['links']['mission_patch'].'">Mission Patch</a>';
        }
        if (!empty($this->response['links']['article_link']))
        {
            $content .= '
        <a href="'.$this->response['links']['article_link'].'">Article</a>';
        }
        if (!empty($this->response['links']['wikipedia']))
        {
            $content .= '
        <a href="'.$this->response['links']['wikipedia'].'">Wikipedia</a>';
        }
        if (!empty($this->response['links']['video_link']))
        {
            $content .= '
        <a href="'.$this->response['links']['video_link'].'">Youtube</a>';
        }

        return $content;
    }
}