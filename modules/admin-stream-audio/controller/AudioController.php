<?php
/**
 * AudioController
 * @package admin-stream-audio
 * @version 0.0.1
 */

namespace AdminStreamAudio\Controller;

use LibFormatter\Library\Formatter;
use LibForm\Library\Form;
use LibForm\Library\Combiner;
use StreamAudio\Model\StreamAudio as SAudio;

class AudioController extends \Admin\Controller
{
    private function getParams(string $title): array{
        return [
            '_meta' => [
                'title' => $title,
                'menus' => ['stream','audio']
            ],
            'subtitle' => $title,
            'pages' => null
        ];
    }

    public function editAction(){
        if(!$this->user->isLogin())
            return $this->loginFirst(1);
        if(!$this->can_i->manage_stream_audio)
            return $this->show404();

        $audio = SAudio::getOne([]);
        if(!$audio)
            return $this->show404();

        $id = $audio->id;

        $params = $this->getParams('Edit Audio Stream');

        $form           = new Form('admin.stream-audio.edit');
        $params['form'] = $form;
        $params['saved'] = false;

        $c_opts = [
            'meta' => [null, null, 'json']
        ];

        $combiner = new Combiner($id, $c_opts, 'stream-audio');
        $audio  = $combiner->prepare($audio);

        if(!($valid = $form->validate($audio)) || !$form->csrfTest('noob'))
            return $this->resp('stream/audio/edit', $params);

        $valid = $combiner->finalize($valid);

        if(!SAudio::set((array)$valid, ['id'=>$id]))
            deb(SAudio::lastError());

        // add the log
        $this->addLog([
            'user'   => $this->user->id,
            'object' => $id,
            'parent' => 0,
            'method' => 2,
            'type'   => 'stream-audio',
            'original' => $audio,
            'changes'  => $valid
        ]);

        $params['saved'] = true;

        return $this->resp('stream/audio/edit', $params);
    }
}