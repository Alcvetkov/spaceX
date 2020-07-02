<?php
namespace Launch;

class HTMLGenerator extends Generator
{
    /** inherit comment */
    public function getContent()
    {
        if (empty($this->response))
        {
            echo 'Could not get the launches information from Space X.' . PHP_EOL;
            return '';
        }

        $html = '
        <table border="1" cellspacing="0" cellpadding="5">
            <tr>
                <th width="15%">Mission name</th>
                <th width="10%">Launch time(UTC)</th>
                <th width="10%">Used rocket</th>
                <th width="40%">Description</th>
                <th width="15%">Mission patch</th>
                <th width="5%">External links</th>
                <th width="5%">Export the launch</th>
            </tr>';

        foreach ($this->response as $launch)
        {
            $html .= '
            <tr>
                <td>'.$launch['mission_name'].'</td>
                <td>'.$launch['launch_date_utc'].'</td>
                <td>'.$launch['rocket']['rocket_name'].'</td>
                <td>'.$launch['details'].'</td>
                <td><img class="patches" src="'.$launch['links']['mission_patch_small'].'"></td>
                <td>';
                if  (!empty($launch['links']['wikipedia']))
                {
                    $html .= '<a href="'.$launch['links']['wikipedia'].'">Wikipedia</a>' . PHP_EOL;
                }
                if  (!empty($launch['links']['video_link']))
                {
                    $html .= '<a href="'.$launch['links']['video_link'].'">Youtube</a>';
                }
                $html .= '</td>
                <td> 
                    <form method="post" target="_blank">
                        <input type="hidden" name="flight_number" value="'.$launch['flight_number'].'" />
                        <input type="submit" name="flight" value="PDF" />
                    </form>
                </td>
            </tr>';
        }

        $html .= '
        </table>';

        return $html;
    }
}