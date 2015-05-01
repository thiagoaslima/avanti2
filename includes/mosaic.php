<?php

class Mosaic_Tile {
	private $title;
	private $url;
	private $link;
	// private $figure_class;
	// private $title_class;

	public static $template = array(
	'<a href="{{link}}" class="{{cols}}">',
    	'<figure class="{{figure_class}}">',
			'<img src="{{url}}">',
			'<figcaption>',
	    		'<span class="{{title_class}}">{{title}}</span>',
			'</figcaption>',
	    '</figure>',
	'</a>'
	);

	public function __construct($title, $url, $link) {
		$this->title = $title;
		$this->url = $url;
		$this->link = $link;
		$this->figure_class = $figure_class;
		$this->title_class = $title_class;
	}

	public function render($figure_class = 'ygviy', $title_class = '') {
		$str = join('', self::$template);
		$str = str_replace('{{link}}', $this->link, $str);
		$str = str_replace('{{figure_class}}', $figure_class, $str);
		$str = str_replace('{{url}}', $this->url, $str);
		$str = str_replace('{{title_class}}', $itle_class, $str);
		$str = str_replace('{{title}}', $this->title, $str);
		return $str;
	}
}

class Mosaic_Tile_Vertically_Aligned extends Mosaic_Tile {
	public static $template = array(
	'<a href="{{link}}" class="{{cols}}">',
    	'<figure class="{{figure_class}}">',
			'<img src="{{url}}">',
			'<figcaption class="vertical-center">',
				'<div class="vertical-center-table">',
	    			'<span class="vertical-center-content {{title_class}}">{{title}}</span>',
	    		'</div>',
			'</figcaption>',
	    '</figure>',
	'</a>'
	);
}


class Mosaic {
	private $cols;

	public static $template = '<div class="offset-sm-1-24 pure-u-18-24">{{tiles}}</div>';
	public $tiles = [];

	public function __construct($tiles, $cols = 1) {
		$this->tiles = $tiles;
		$this->cols = $cols;
		$this->template = $template;
	}

	public function render($figure_class = '', $title_class = '') {
		$n_cols = $this->cols; 
		$larg_col = ceil(24/$n_cols);
		$col_class = 'pure-u-' . $larg_col . '-24';

		if (count($this->tiles) === 0):
			return '';
		else:
			$tiles = '';

			$colunas = [];
			for ($i=0; $i < $n_cols; $i++) : 
				$colunas[$i] = [];
			endfor;

			for ($i=0; $i < count($this->tiles); $i++) :
				array_push($colunas[$i%$n_cols], $this->tiles[$i]);
			endfor;

			foreach ($colunas as $coluna) :
				$tiles .= '<div class="' . $col_class . '">';

				foreach ($coluna as $tile) :
					$tiles .= str_replace('{{cols}}', $col_class, $tile->render($figure_class, $title_class));
				endforeach;


				$tiles .= '</div>';
			endforeach;
			

			return str_replace('{{tiles}}', $tiles, self::$template);
		endif;
	}
}