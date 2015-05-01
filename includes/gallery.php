<?php

class Slide {
	public $url;
	public $width;
	public $height;
	public $content;

	public function __construct($url, $width, $height, $content) {
		$this->url = $url;
		$this->width = $width;
		$this->height = $height;
		$this->content = $content;
	}

	public function render() {
		return sprintf('<div class="gallery-carousel-slide" style="width:%dpx; height:%dpx; background-image:url(\'%s\');">%s</div>', $this->width, $this->height, $this->url, $this->content);
	}
}

class Gallery {
	private $template = '<div class="galeria galeria-capa">{{slides}}</div>';
	private $arrows = false;
	private $dots = false;
	private $slides;

	public function __construct($slides, $arrows = false, $dots = false) {
		$this->slides = $slides;
		$this->arrows = $arrows;
		$this->dots = $dots;
	}

	public function render() {
		$slides = '';
		foreach ($this->slides as $slide) {
			$slides .= $slide->render();
		}

		return str_replace('{{slides}}', $slides, $this->template);
	}
}