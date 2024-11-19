<?php

namespace Jeffreyvr\WPMetaBox;

class EnqueueManager
{
    public array $enqueued = [];
    public bool $is_enqueued = false;

    public function add($handle, $callback)
    {
        $this->enqueued[$handle] = $callback;
    }

    public function remove($handle)
    {
        unset($this->enqueued[$handle]);
    }

    public function enqueue()
    {
        if($this->is_enqueued) {
            return;
        }

        foreach ($this->enqueued as $enqueue) {
            $enqueue();
        }

        $this->enqueued();
    }

    public function enqueued()
    {
        $this->is_enqueued = true;

        return $this;
    }
}
