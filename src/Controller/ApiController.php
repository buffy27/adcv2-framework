<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/api", name="api")
 */
class ApiController extends AbstractController
{
    /**
     * @Route("/template", name="api.template", methods={"GET"})
     */
    public function template(): JsonResponse
    {
        $template = ["dvd_template" => "```Distributor............:  
Country................: 
Director...............: 
DVD Format.............: 
DVD Size...............:  
Screen Format..........:
Video Resolution.......: 
Audio Language.........: 
Audio Format...........: 
Subtitles..............: 
Scans..................:


Menu...................: [x] Untouched
                         [ ] Stripped

Video..................: [x] Untouched
                         [ ] Re-encoded

DVD Extras.............: [x] Untouched
                         [ ] Re-encoded
                         [ ] Stripped
                         [ ] None on source


Uploader's Comments....:
```", "bdmv_template" => "```
Distributor............:  
Country................: 
Director...............:  
Blu-ray Codec..........: 
Blu-ray Size...........:  
Screen Format..........:
Video Resolution.......: 
Audio Language.........: 
Audio Format...........: 
Subtitles..............: 
Scans..................:


Menu...................: [x] Untouched
                         [ ] Stripped

Video..................: [x] Untouched
                         [ ] Re-encoded

Blu-ray Extras.........: [x] Untouched
                         [ ] Re-encoded
                         [ ] Stripped
                         [ ] None on source


Uploader's Comments....:


```
", "uhd_template" => "```
Distributor............: 
Country................: 
Director...............:   
UHD Blu-ray Size.......:
Video Resolution.......:   
Audio Language.........: 
Audio Format...........: 
Subtitles..............: 
Scans..................:


Menu...................: [x] Untouched
                         [ ] Stripped

Video..................: [x] Untouched
                         [ ] Re-encoded

Extras.................: [x] Untouched
                         [ ] Re-encoded
                         [ ] Stripped
                         [ ] None on source


Uploader's Comments....:


```
"];
       $response = new JsonResponse($template);
       $response->setEncodingOptions($response->getEncodingOptions() | JSON_PRETTY_PRINT);
       return $response ;
    }

    /**
     * @Route ("/scrapper/{type}", name="api.scrapper", methods={"GET"}, requirements={"type"="^[a-z]+$"})
     */
    public function scrapper($type, Request $request){
        $command = "python3 " . $this->getParameter('kernel.project_dir') . "/data/scrappers/";
        if($type == "mal"){
             $command .= "mal_to_json.py " . $this->getMAL_id($request->query->get("url"));
             $data = exec($command, $out, $status);
             $data = json_decode($data, true);
             dump($data);
             $data = array(
                'content_info' =>
                    $data['title'] . "<br>" .
                    $data['title_jp'] . "<br>" .
                    $data['type'] . "<br>" .
                    $data['episodes'] . "<br>" .
                    $data['year'] . "<br>" .
                    $data['duration'] . "<br>" .
                    $data['studios'] . "<br>" .
                    $data['genres'] . "<br>" .
                    $data['directors'] . "<br><br>".
                    $data['synopsis'],

                'image' => $data['url']
             );

              //  $data = json_decode($data, true);
             return new JsonResponse($data);
        }
        return new JsonResponse("Not found 404");
    }

    private function getIMDb_id($imdb_url){
        $pos = strpos($imdb_url, "/tt");
        $imdb_url = substr($imdb_url, $pos + 3, strlen($imdb_url));
        $chars = str_split($imdb_url);
        $imdb_url = "";
        foreach ($chars as $value) {
            if (is_numeric($value))
                $imdb_url .= $value;
            else
                break;
        }
        return $imdb_url;
    }
    private function getMAL_id($maldb_url){
        $pos = strpos($maldb_url, "e/");
        $maldb_url = substr($maldb_url, $pos + 2,  strlen($maldb_url));
        $pos = strpos($maldb_url, "/");
        if(!empty($pos))
            $maldb_url = substr($maldb_url, 0,  $pos);
        return $maldb_url;
    }
    public function getScrapperId($type, $url){
        if($type == "mal"){
            return $this->getMAL_id($url);
        }else{
            return $this->getIMDb_id($url);
        }
    }
}
