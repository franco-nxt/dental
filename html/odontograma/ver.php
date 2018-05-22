<div class="bar-subtitle">
	<div class="container">
		<a href="<?= $Patient->url() ?>"><?= $Patient->fullname() ?></a>
	</div>
</div>
<div class="bar-btn">
	<div class="container">
		<a class="btn btn-primary" href="<?= $Odontogram->url('editar') ?>">EDITAR</a>
		<a class="btn btn-default" href="<?= URL_ROOT ?>/odontograma/<?= $Treatment->url ?>">CANCELAR</a>
	</div>
</div>
<div class="container">
	<div class="bar-bordered mt5 mb5">
		<span><?= $Treatment->fecha_hora_inicio ?> - <?= $Treatment->estado ?> - <?= $Treatment->tecnica ?></span>
	</div>
	<div class="row odntgrm-wrap">
		<div class="odntgrm">
			<div class="col-xs-6"><!-- SUPERIOR IZQUIERDA -->
				<div class="odntgrm-piece">
					<div><?= $Odontogram->piece(18, 'RH') ?></div>
					<span>18</span>
					<svg version="1.0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 26.5 39" data-id="18">
						<rect width="26.5" height="26.5" fill="#212121"></rect>
						<rect x="8.2" y="8.3" fill="#<?= $Odontogram->piece(18, 'A1') ?>" width="10" height="10" class="a1"></rect>
						<polygon fill="#<?= $Odontogram->piece(18, 'A2') ?>" points="25.9,25.4 19.1,18.5 19.1,8 26,1.1" class="a2"></polygon>
						<polygon fill="#<?= $Odontogram->piece(18, 'A3') ?>" points="7.4,18.5 0.5,25.4 0.5,1.1 7.4,8" class="a3"></polygon>
						<polygon fill="#<?= $Odontogram->piece(18, 'A4') ?>" points="18.5,7.4 7.9,7.4 1.1,0.5 25.4,0.5" class="a4"></polygon>
						<polygon fill="#<?= $Odontogram->piece(18, 'A5') ?>" points="25.4,26 1.1,26 7.9,19.1 18.5,19.1" class="a5"></polygon>
						<?= $Odontogram->piece(18, 'SVG') ?>
					</svg>
				</div>
				<div class="odntgrm-piece">
					<div><?= $Odontogram->piece(17, 'RH') ?></div>
					<span>17</span>
					<svg version="1.0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 26.5 39" data-id="17">
						<rect width="26.5" height="26.5" fill="#212121"></rect>
						<rect x="8.2" y="8.3" fill="#<?= $Odontogram->piece(17, 'A1') ?>" width="10" height="10" class="a1"></rect>
						<polygon fill="#<?= $Odontogram->piece(17, 'A2') ?>" points="25.9,25.4 19.1,18.5 19.1,8 26,1.1" class="a2"></polygon>
						<polygon fill="#<?= $Odontogram->piece(17, 'A3') ?>" points="7.4,18.5 0.5,25.4 0.5,1.1 7.4,8" class="a3"></polygon>
						<polygon fill="#<?= $Odontogram->piece(17, 'A4') ?>" points="18.5,7.4 7.9,7.4 1.1,0.5 25.4,0.5" class="a4"></polygon>
						<polygon fill="#<?= $Odontogram->piece(17, 'A5') ?>" points="25.4,26 1.1,26 7.9,19.1 18.5,19.1" class="a5"></polygon>
						<?= $Odontogram->piece(17, 'SVG') ?>
					</svg>
				</div>
				<div class="odntgrm-piece">
					<div><?= $Odontogram->piece(16, 'RH')?></div>
					<span>16</span>
					<svg version="1.0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 26.5 39" data-id="16">
						<rect width="26.5" height="26.5" fill="#212121"></rect>
						<rect x="8.2" y="8.3" fill="#<?= $Odontogram->piece(16, 'A1') ?>" width="10" height="10" class="a1"></rect>
						<polygon fill="#<?= $Odontogram->piece(16, 'A2') ?>" points="25.9,25.4 19.1,18.5 19.1,8 26,1.1" class="a2"></polygon>
						<polygon fill="#<?= $Odontogram->piece(16, 'A3') ?>" points="7.4,18.5 0.5,25.4 0.5,1.1 7.4,8" class="a3"></polygon>
						<polygon fill="#<?= $Odontogram->piece(16, 'A4') ?>" points="18.5,7.4 7.9,7.4 1.1,0.5 25.4,0.5" class="a4"></polygon>
						<polygon fill="#<?= $Odontogram->piece(16, 'A5') ?>" points="25.4,26 1.1,26 7.9,19.1 18.5,19.1" class="a5"></polygon>
						<?= $Odontogram->piece(16, 'SVG') ?>
					</svg>
				</div>
				<div class="odntgrm-piece">
					<div><?= $Odontogram->piece(15, 'RH')?></div>
					<span>15</span>
					<svg version="1.0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 26.5 39" data-id="15">
						<rect width="26.5" height="26.5" fill="#212121"></rect>
						<rect x="8.2" y="8.3" fill="#<?= $Odontogram->piece(15, 'A1') ?>" width="10" height="10" class="a1"></rect>
						<polygon fill="#<?= $Odontogram->piece(15, 'A2') ?>" points="25.9,25.4 19.1,18.5 19.1,8 26,1.1" class="a2"></polygon>
						<polygon fill="#<?= $Odontogram->piece(15, 'A3') ?>" points="7.4,18.5 0.5,25.4 0.5,1.1 7.4,8" class="a3"></polygon>
						<polygon fill="#<?= $Odontogram->piece(15, 'A4') ?>" points="18.5,7.4 7.9,7.4 1.1,0.5 25.4,0.5" class="a4"></polygon>
						<polygon fill="#<?= $Odontogram->piece(15, 'A5') ?>" points="25.4,26 1.1,26 7.9,19.1 18.5,19.1" class="a5"></polygon>
						<?= $Odontogram->piece(15, 'SVG') ?>
					</svg>
				</div>
				<div class="odntgrm-piece">
					<div><?= $Odontogram->piece(14, 'RH')?></div>
					<span>14</span>
					<svg version="1.0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 26.5 39" data-id="14">
						<rect width="26.5" height="26.5" fill="#212121"></rect>
						<rect x="8.2" y="8.3" fill="#<?= $Odontogram->piece(14, 'A1') ?>" width="10" height="10" class="a1"></rect>
						<polygon fill="#<?= $Odontogram->piece(14, 'A2') ?>" points="25.9,25.4 19.1,18.5 19.1,8 26,1.1" class="a2"></polygon>
						<polygon fill="#<?= $Odontogram->piece(14, 'A3') ?>" points="7.4,18.5 0.5,25.4 0.5,1.1 7.4,8" class="a3"></polygon>
						<polygon fill="#<?= $Odontogram->piece(14, 'A4') ?>" points="18.5,7.4 7.9,7.4 1.1,0.5 25.4,0.5" class="a4"></polygon>
						<polygon fill="#<?= $Odontogram->piece(14, 'A5') ?>" points="25.4,26 1.1,26 7.9,19.1 18.5,19.1" class="a5"></polygon>
						<?= $Odontogram->piece(14, 'SVG') ?>
					</svg>
				</div>
				<div class="odntgrm-piece">
					<div><?= $Odontogram->piece(13, 'RH')?></div>
					<span>13</span>
					<svg version="1.0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 26.5 39" data-id="13">
						<rect width="26.5" height="26.5" fill="#212121"></rect>
						<rect x="8.2" y="8.3" fill="#<?= $Odontogram->piece(13, 'A1') ?>" width="10" height="10" class="a1"></rect>
						<polygon fill="#<?= $Odontogram->piece(13, 'A2') ?>" points="25.9,25.4 19.1,18.5 19.1,8 26,1.1" class="a2"></polygon>
						<polygon fill="#<?= $Odontogram->piece(13, 'A3') ?>" points="7.4,18.5 0.5,25.4 0.5,1.1 7.4,8" class="a3"></polygon>
						<polygon fill="#<?= $Odontogram->piece(13, 'A4') ?>" points="18.5,7.4 7.9,7.4 1.1,0.5 25.4,0.5" class="a4"></polygon>
						<polygon fill="#<?= $Odontogram->piece(13, 'A5') ?>" points="25.4,26 1.1,26 7.9,19.1 18.5,19.1" class="a5"></polygon>
						<?= $Odontogram->piece(13, 'SVG') ?>
					</svg>
				</div>
				<div class="odntgrm-piece">
					<div><?= $Odontogram->piece(12, 'RH')?></div>
					<span>12</span>
					<svg version="1.0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 26.5 39" data-id="12">
						<rect width="26.5" height="26.5" fill="#212121"></rect>
						<rect x="8.2" y="8.3" fill="#<?= $Odontogram->piece(12, 'A1') ?>" width="10" height="10" class="a1"></rect>
						<polygon fill="#<?= $Odontogram->piece(12, 'A2') ?>" points="25.9,25.4 19.1,18.5 19.1,8 26,1.1" class="a2"></polygon>
						<polygon fill="#<?= $Odontogram->piece(12, 'A3') ?>" points="7.4,18.5 0.5,25.4 0.5,1.1 7.4,8" class="a3"></polygon>
						<polygon fill="#<?= $Odontogram->piece(12, 'A4') ?>" points="18.5,7.4 7.9,7.4 1.1,0.5 25.4,0.5" class="a4"></polygon>
						<polygon fill="#<?= $Odontogram->piece(12, 'A5') ?>" points="25.4,26 1.1,26 7.9,19.1 18.5,19.1" class="a5"></polygon>
						<?= $Odontogram->piece(12, 'SVG') ?>
					</svg>
				</div>
				<div class="odntgrm-piece">
					<div><?= $Odontogram->piece(11, 'RH')?></div>
					<span>11</span>
					<svg version="1.0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 26.5 39" data-id="11">
						<rect width="26.5" height="26.5" fill="#212121"></rect>
						<rect x="8.2" y="8.3" fill="#<?= $Odontogram->piece(11, 'A1') ?>" width="10" height="10" class="a1"></rect>
						<polygon fill="#<?= $Odontogram->piece(11, 'A2') ?>" points="25.9,25.4 19.1,18.5 19.1,8 26,1.1" class="a2"></polygon>
						<polygon fill="#<?= $Odontogram->piece(11, 'A3') ?>" points="7.4,18.5 0.5,25.4 0.5,1.1 7.4,8" class="a3"></polygon>
						<polygon fill="#<?= $Odontogram->piece(11, 'A4') ?>" points="18.5,7.4 7.9,7.4 1.1,0.5 25.4,0.5" class="a4"></polygon>
						<polygon fill="#<?= $Odontogram->piece(11, 'A5') ?>" points="25.4,26 1.1,26 7.9,19.1 18.5,19.1" class="a5"></polygon>
						<?= $Odontogram->piece(11, 'SVG') ?>
					</svg>
				</div>
			</div>
			<div class="col-xs-6"><!-- SUPERIOR DERECHA -->
				<div class="odntgrm-piece">
					<div><?= $Odontogram->piece(21, 'RH')?></div>
					<span>21</span>
					<svg version="1.0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 26.5 39" data-id="21">
						<rect width="26.5" height="26.5" fill="#212121"></rect>
						<rect x="8.2" y="8.3" fill="#<?= $Odontogram->piece(21, 'A1') ?>" width="10" height="10" class="a1"></rect>
						<polygon fill="#<?= $Odontogram->piece(21, 'A2') ?>" points="25.9,25.4 19.1,18.5 19.1,8 26,1.1" class="a2"></polygon>
						<polygon fill="#<?= $Odontogram->piece(21, 'A3') ?>" points="7.4,18.5 0.5,25.4 0.5,1.1 7.4,8" class="a3"></polygon>
						<polygon fill="#<?= $Odontogram->piece(21, 'A4') ?>" points="18.5,7.4 7.9,7.4 1.1,0.5 25.4,0.5" class="a4"></polygon>
						<polygon fill="#<?= $Odontogram->piece(21, 'A5') ?>" points="25.4,26 1.1,26 7.9,19.1 18.5,19.1" class="a5"></polygon>
						<?= $Odontogram->piece(21, 'SVG') ?>
					</svg>
				</div>
				<div class="odntgrm-piece">
					<div><?= $Odontogram->piece(22, 'RH')?></div>
					<span>22</span>
					<svg version="1.0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 26.5 39" data-id="22">
						<rect width="26.5" height="26.5" fill="#212121"></rect>
						<rect x="8.2" y="8.3" fill="#<?= $Odontogram->piece(22, 'A1') ?>" width="10" height="10" class="a1"></rect>
						<polygon fill="#<?= $Odontogram->piece(22, 'A2') ?>" points="25.9,25.4 19.1,18.5 19.1,8 26,1.1" class="a2"></polygon>
						<polygon fill="#<?= $Odontogram->piece(22, 'A3') ?>" points="7.4,18.5 0.5,25.4 0.5,1.1 7.4,8" class="a3"></polygon>
						<polygon fill="#<?= $Odontogram->piece(22, 'A4') ?>" points="18.5,7.4 7.9,7.4 1.1,0.5 25.4,0.5" class="a4"></polygon>
						<polygon fill="#<?= $Odontogram->piece(22, 'A5') ?>" points="25.4,26 1.1,26 7.9,19.1 18.5,19.1" class="a5"></polygon>
						<?= $Odontogram->piece(22, 'SVG') ?>
					</svg>
				</div>
				<div class="odntgrm-piece">
					<div><?= $Odontogram->piece(23, 'RH')?></div>
					<span>23</span>
					<svg version="1.0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 26.5 39" data-id="23">
						<rect width="26.5" height="26.5" fill="#212121"></rect>
						<rect x="8.2" y="8.3" fill="#<?= $Odontogram->piece(23, 'A1') ?>" width="10" height="10" class="a1"></rect>
						<polygon fill="#<?= $Odontogram->piece(23, 'A2') ?>" points="25.9,25.4 19.1,18.5 19.1,8 26,1.1" class="a2"></polygon>
						<polygon fill="#<?= $Odontogram->piece(23, 'A3') ?>" points="7.4,18.5 0.5,25.4 0.5,1.1 7.4,8" class="a3"></polygon>
						<polygon fill="#<?= $Odontogram->piece(23, 'A4') ?>" points="18.5,7.4 7.9,7.4 1.1,0.5 25.4,0.5" class="a4"></polygon>
						<polygon fill="#<?= $Odontogram->piece(23, 'A5') ?>" points="25.4,26 1.1,26 7.9,19.1 18.5,19.1" class="a5"></polygon>
						<?= $Odontogram->piece(23, 'SVG') ?>
					</svg>
				</div>
				<div class="odntgrm-piece">
					<div><?= $Odontogram->piece(24, 'RH')?></div>
					<span>24</span>
					<svg version="1.0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 26.5 39" data-id="24">
						<rect width="26.5" height="26.5" fill="#212121"></rect>
						<rect x="8.2" y="8.3" fill="#<?= $Odontogram->piece(24, 'A1') ?>" width="10" height="10" class="a1"></rect>
						<polygon fill="#<?= $Odontogram->piece(24, 'A2') ?>" points="25.9,25.4 19.1,18.5 19.1,8 26,1.1" class="a2"></polygon>
						<polygon fill="#<?= $Odontogram->piece(24, 'A3') ?>" points="7.4,18.5 0.5,25.4 0.5,1.1 7.4,8" class="a3"></polygon>
						<polygon fill="#<?= $Odontogram->piece(24, 'A4') ?>" points="18.5,7.4 7.9,7.4 1.1,0.5 25.4,0.5" class="a4"></polygon>
						<polygon fill="#<?= $Odontogram->piece(24, 'A5') ?>" points="25.4,26 1.1,26 7.9,19.1 18.5,19.1" class="a5"></polygon>
						<?= $Odontogram->piece(24, 'SVG') ?>
					</svg>
				</div>
				<div class="odntgrm-piece">
					<div><?= $Odontogram->piece(25, 'RH')?></div>
					<span>25</span>
					<svg version="1.0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 26.5 39" data-id="25">
						<rect width="26.5" height="26.5" fill="#212121"></rect>
						<rect x="8.2" y="8.3" fill="#<?= $Odontogram->piece(25, 'A1') ?>" width="10" height="10" class="a1"></rect>
						<polygon fill="#<?= $Odontogram->piece(25, 'A2') ?>" points="25.9,25.4 19.1,18.5 19.1,8 26,1.1" class="a2"></polygon>
						<polygon fill="#<?= $Odontogram->piece(25, 'A3') ?>" points="7.4,18.5 0.5,25.4 0.5,1.1 7.4,8" class="a3"></polygon>
						<polygon fill="#<?= $Odontogram->piece(25, 'A4') ?>" points="18.5,7.4 7.9,7.4 1.1,0.5 25.4,0.5" class="a4"></polygon>
						<polygon fill="#<?= $Odontogram->piece(25, 'A5') ?>" points="25.4,26 1.1,26 7.9,19.1 18.5,19.1" class="a5"></polygon>
						<?= $Odontogram->piece(25, 'SVG') ?>
					</svg>
				</div>
				<div class="odntgrm-piece">
					<div><?= $Odontogram->piece(26, 'RH')?></div>
					<span>26</span>
					<svg version="1.0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 26.5 39" data-id="26">
						<rect width="26.5" height="26.5" fill="#212121"></rect>
						<rect x="8.2" y="8.3" fill="#<?= $Odontogram->piece(26, 'A1') ?>" width="10" height="10" class="a1"></rect>
						<polygon fill="#<?= $Odontogram->piece(26, 'A2') ?>" points="25.9,25.4 19.1,18.5 19.1,8 26,1.1" class="a2"></polygon>
						<polygon fill="#<?= $Odontogram->piece(26, 'A3') ?>" points="7.4,18.5 0.5,25.4 0.5,1.1 7.4,8" class="a3"></polygon>
						<polygon fill="#<?= $Odontogram->piece(26, 'A4') ?>" points="18.5,7.4 7.9,7.4 1.1,0.5 25.4,0.5" class="a4"></polygon>
						<polygon fill="#<?= $Odontogram->piece(26, 'A5') ?>" points="25.4,26 1.1,26 7.9,19.1 18.5,19.1" class="a5"></polygon>
						<?= $Odontogram->piece(26, 'SVG') ?>
					</svg>
				</div>
				<div class="odntgrm-piece">
					<div><?= $Odontogram->piece(27, 'RH')?></div>
					<span>27</span>
					<svg version="1.0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 26.5 39" data-id="27">
						<rect width="26.5" height="26.5" fill="#212121"></rect>
						<rect x="8.2" y="8.3" fill="#<?= $Odontogram->piece(27, 'A1') ?>" width="10" height="10" class="a1"></rect>
						<polygon fill="#<?= $Odontogram->piece(27, 'A2') ?>" points="25.9,25.4 19.1,18.5 19.1,8 26,1.1" class="a2"></polygon>
						<polygon fill="#<?= $Odontogram->piece(27, 'A3') ?>" points="7.4,18.5 0.5,25.4 0.5,1.1 7.4,8" class="a3"></polygon>
						<polygon fill="#<?= $Odontogram->piece(27, 'A4') ?>" points="18.5,7.4 7.9,7.4 1.1,0.5 25.4,0.5" class="a4"></polygon>
						<polygon fill="#<?= $Odontogram->piece(27, 'A5') ?>" points="25.4,26 1.1,26 7.9,19.1 18.5,19.1" class="a5"></polygon>
						<?= $Odontogram->piece(27, 'SVG') ?>
					</svg>
				</div>
				<div class="odntgrm-piece">
					<div><?= $Odontogram->piece(28, 'RH')?></div>
					<span>28</span>
					<svg version="1.0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 26.5 39" data-id="28">
						<rect width="26.5" height="26.5" fill="#212121"></rect>
						<rect x="8.2" y="8.3" fill="#<?= $Odontogram->piece(28, 'A1') ?>" width="10" height="10" class="a1"></rect>
						<polygon fill="#<?= $Odontogram->piece(28, 'A2') ?>" points="25.9,25.4 19.1,18.5 19.1,8 26,1.1" class="a2"></polygon>
						<polygon fill="#<?= $Odontogram->piece(28, 'A3') ?>" points="7.4,18.5 0.5,25.4 0.5,1.1 7.4,8" class="a3"></polygon>
						<polygon fill="#<?= $Odontogram->piece(28, 'A4') ?>" points="18.5,7.4 7.9,7.4 1.1,0.5 25.4,0.5" class="a4"></polygon>
						<polygon fill="#<?= $Odontogram->piece(28, 'A5') ?>" points="25.4,26 1.1,26 7.9,19.1 18.5,19.1" class="a5"></polygon>
						<?= $Odontogram->piece(28, 'SVG') ?>
					</svg>
				</div>
			</div>
			<div class="col-xs-6"><!-- INFERIOR IZQUIERDA -->
				<div class="odntgrm-piece">
					<div><?= $Odontogram->piece(48, 'RH')?></div>
					<span>48</span>
					<svg version="1.0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 26.5 39" data-id="48">
						<rect width="26.5" height="26.5" fill="#212121"></rect>
						<rect x="8.2" y="8.3" fill="#<?= $Odontogram->piece(48, 'A1') ?>" width="10" height="10" class="a1"></rect>
						<polygon fill="#<?= $Odontogram->piece(48, 'A2') ?>" points="25.9,25.4 19.1,18.5 19.1,8 26,1.1" class="a2"></polygon>
						<polygon fill="#<?= $Odontogram->piece(48, 'A3') ?>" points="7.4,18.5 0.5,25.4 0.5,1.1 7.4,8" class="a3"></polygon>
						<polygon fill="#<?= $Odontogram->piece(48, 'A4') ?>" points="18.5,7.4 7.9,7.4 1.1,0.5 25.4,0.5" class="a4"></polygon>
						<polygon fill="#<?= $Odontogram->piece(48, 'A5') ?>" points="25.4,26 1.1,26 7.9,19.1 18.5,19.1" class="a5"></polygon>
						<?= $Odontogram->piece(48, 'SVG') ?>
					</svg>
				</div>
				<div class="odntgrm-piece">
					<div><?= $Odontogram->piece(47, 'RH')?></div>
					<span>47</span>
					<svg version="1.0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 26.5 39" data-id="47">
						<rect width="26.5" height="26.5" fill="#212121"></rect>
						<rect x="8.2" y="8.3" fill="#<?= $Odontogram->piece(47, 'A1') ?>" width="10" height="10" class="a1"></rect>
						<polygon fill="#<?= $Odontogram->piece(47, 'A2') ?>" points="25.9,25.4 19.1,18.5 19.1,8 26,1.1" class="a2"></polygon>
						<polygon fill="#<?= $Odontogram->piece(47, 'A3') ?>" points="7.4,18.5 0.5,25.4 0.5,1.1 7.4,8" class="a3"></polygon>
						<polygon fill="#<?= $Odontogram->piece(47, 'A4') ?>" points="18.5,7.4 7.9,7.4 1.1,0.5 25.4,0.5" class="a4"></polygon>
						<polygon fill="#<?= $Odontogram->piece(47, 'A5') ?>" points="25.4,26 1.1,26 7.9,19.1 18.5,19.1" class="a5"></polygon>
						<?= $Odontogram->piece(47, 'SVG') ?>
					</svg>
				</div>
				<div class="odntgrm-piece">
					<div><?= $Odontogram->piece(46, 'RH')?></div>
					<span>46</span>
					<svg version="1.0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 26.5 39" data-id="46">
						<rect width="26.5" height="26.5" fill="#212121"></rect>
						<rect x="8.2" y="8.3" fill="#<?= $Odontogram->piece(46, 'A1') ?>" width="10" height="10" class="a1"></rect>
						<polygon fill="#<?= $Odontogram->piece(46, 'A2') ?>" points="25.9,25.4 19.1,18.5 19.1,8 26,1.1" class="a2"></polygon>
						<polygon fill="#<?= $Odontogram->piece(46, 'A3') ?>" points="7.4,18.5 0.5,25.4 0.5,1.1 7.4,8" class="a3"></polygon>
						<polygon fill="#<?= $Odontogram->piece(46, 'A4') ?>" points="18.5,7.4 7.9,7.4 1.1,0.5 25.4,0.5" class="a4"></polygon>
						<polygon fill="#<?= $Odontogram->piece(46, 'A5') ?>" points="25.4,26 1.1,26 7.9,19.1 18.5,19.1" class="a5"></polygon>
						<?= $Odontogram->piece(46, 'SVG') ?>
					</svg>
				</div>
				<div class="odntgrm-piece">
					<div><?= $Odontogram->piece(45, 'RH')?></div>
					<span>45</span>
					<svg version="1.0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 26.5 39" data-id="45">
						<rect width="26.5" height="26.5" fill="#212121"></rect>
						<rect x="8.2" y="8.3" fill="#<?= $Odontogram->piece(45, 'A1') ?>" width="10" height="10" class="a1"></rect>
						<polygon fill="#<?= $Odontogram->piece(45, 'A2') ?>" points="25.9,25.4 19.1,18.5 19.1,8 26,1.1" class="a2"></polygon>
						<polygon fill="#<?= $Odontogram->piece(45, 'A3') ?>" points="7.4,18.5 0.5,25.4 0.5,1.1 7.4,8" class="a3"></polygon>
						<polygon fill="#<?= $Odontogram->piece(45, 'A4') ?>" points="18.5,7.4 7.9,7.4 1.1,0.5 25.4,0.5" class="a4"></polygon>
						<polygon fill="#<?= $Odontogram->piece(45, 'A5') ?>" points="25.4,26 1.1,26 7.9,19.1 18.5,19.1" class="a5"></polygon>
						<?= $Odontogram->piece(45, 'SVG') ?>
					</svg>
				</div>
				<div class="odntgrm-piece">
					<div><?= $Odontogram->piece(44, 'RH')?></div>
					<span>44</span>
					<svg version="1.0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 26.5 39" data-id="44">
						<rect width="26.5" height="26.5" fill="#212121"></rect>
						<rect x="8.2" y="8.3" fill="#<?= $Odontogram->piece(44, 'A1') ?>" width="10" height="10" class="a1"></rect>
						<polygon fill="#<?= $Odontogram->piece(44, 'A2') ?>" points="25.9,25.4 19.1,18.5 19.1,8 26,1.1" class="a2"></polygon>
						<polygon fill="#<?= $Odontogram->piece(44, 'A3') ?>" points="7.4,18.5 0.5,25.4 0.5,1.1 7.4,8" class="a3"></polygon>
						<polygon fill="#<?= $Odontogram->piece(44, 'A4') ?>" points="18.5,7.4 7.9,7.4 1.1,0.5 25.4,0.5" class="a4"></polygon>
						<polygon fill="#<?= $Odontogram->piece(44, 'A5') ?>" points="25.4,26 1.1,26 7.9,19.1 18.5,19.1" class="a5"></polygon>
						<?= $Odontogram->piece(44, 'SVG') ?>
					</svg>
				</div>
				<div class="odntgrm-piece">
					<div><?= $Odontogram->piece(43, 'RH')?></div>
					<span>43</span>
					<svg version="1.0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 26.5 39" data-id="43">
						<rect width="26.5" height="26.5" fill="#212121"></rect>
						<rect x="8.2" y="8.3" fill="#<?= $Odontogram->piece(43, 'A1') ?>" width="10" height="10" class="a1"></rect>
						<polygon fill="#<?= $Odontogram->piece(43, 'A2') ?>" points="25.9,25.4 19.1,18.5 19.1,8 26,1.1" class="a2"></polygon>
						<polygon fill="#<?= $Odontogram->piece(43, 'A3') ?>" points="7.4,18.5 0.5,25.4 0.5,1.1 7.4,8" class="a3"></polygon>
						<polygon fill="#<?= $Odontogram->piece(43, 'A4') ?>" points="18.5,7.4 7.9,7.4 1.1,0.5 25.4,0.5" class="a4"></polygon>
						<polygon fill="#<?= $Odontogram->piece(43, 'A5') ?>" points="25.4,26 1.1,26 7.9,19.1 18.5,19.1" class="a5"></polygon>
						<?= $Odontogram->piece(43, 'SVG') ?>
					</svg>
				</div>
				<div class="odntgrm-piece">
					<div><?= $Odontogram->piece(42, 'RH')?></div>
					<span>42</span>
					<svg version="1.0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 26.5 39" data-id="42">
						<rect width="26.5" height="26.5" fill="#212121"></rect>
						<rect x="8.2" y="8.3" fill="#<?= $Odontogram->piece(42, 'A1') ?>" width="10" height="10" class="a1"></rect>
						<polygon fill="#<?= $Odontogram->piece(42, 'A2') ?>" points="25.9,25.4 19.1,18.5 19.1,8 26,1.1" class="a2"></polygon>
						<polygon fill="#<?= $Odontogram->piece(42, 'A3') ?>" points="7.4,18.5 0.5,25.4 0.5,1.1 7.4,8" class="a3"></polygon>
						<polygon fill="#<?= $Odontogram->piece(42, 'A4') ?>" points="18.5,7.4 7.9,7.4 1.1,0.5 25.4,0.5" class="a4"></polygon>
						<polygon fill="#<?= $Odontogram->piece(42, 'A5') ?>" points="25.4,26 1.1,26 7.9,19.1 18.5,19.1" class="a5"></polygon>
						<?= $Odontogram->piece(42, 'SVG') ?>
					</svg>
				</div>
				<div class="odntgrm-piece">
					<div><?= $Odontogram->piece(41, 'RH')?></div>
					<span>41</span>
					<svg version="1.0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 26.5 39" data-id="41">
						<rect width="26.5" height="26.5" fill="#212121"></rect>
						<rect x="8.2" y="8.3" fill="#<?= $Odontogram->piece(41, 'A1') ?>" width="10" height="10" class="a1"></rect>
						<polygon fill="#<?= $Odontogram->piece(41, 'A2') ?>" points="25.9,25.4 19.1,18.5 19.1,8 26,1.1" class="a2"></polygon>
						<polygon fill="#<?= $Odontogram->piece(41, 'A3') ?>" points="7.4,18.5 0.5,25.4 0.5,1.1 7.4,8" class="a3"></polygon>
						<polygon fill="#<?= $Odontogram->piece(41, 'A4') ?>" points="18.5,7.4 7.9,7.4 1.1,0.5 25.4,0.5" class="a4"></polygon>
						<polygon fill="#<?= $Odontogram->piece(41, 'A5') ?>" points="25.4,26 1.1,26 7.9,19.1 18.5,19.1" class="a5"></polygon>
						<?= $Odontogram->piece(41, 'SVG') ?>
					</svg>
				</div>
			</div>
			<div class="col-xs-6"><!-- INFERIOR DERECHA -->
				<div class="odntgrm-piece">
					<div><?= $Odontogram->piece(31, 'RH')?></div>
					<span>31</span>
					<svg version="1.0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 26.5 39" data-id="31">
						<rect width="26.5" height="26.5" fill="#212121"></rect>
						<rect x="8.2" y="8.3" fill="#<?= $Odontogram->piece(31, 'A1') ?>" width="10" height="10" class="a1"></rect>
						<polygon fill="#<?= $Odontogram->piece(31, 'A2') ?>" points="25.9,25.4 19.1,18.5 19.1,8 26,1.1" class="a2"></polygon>
						<polygon fill="#<?= $Odontogram->piece(31, 'A3') ?>" points="7.4,18.5 0.5,25.4 0.5,1.1 7.4,8" class="a3"></polygon>
						<polygon fill="#<?= $Odontogram->piece(31, 'A4') ?>" points="18.5,7.4 7.9,7.4 1.1,0.5 25.4,0.5" class="a4"></polygon>
						<polygon fill="#<?= $Odontogram->piece(31, 'A5') ?>" points="25.4,26 1.1,26 7.9,19.1 18.5,19.1" class="a5"></polygon>
						<?= $Odontogram->piece(31, 'SVG') ?>
					</svg>
				</div>
				<div class="odntgrm-piece">
					<div><?= $Odontogram->piece(32, 'RH')?></div>
					<span>32</span>
					<svg version="1.0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 26.5 39" data-id="32">
						<rect width="26.5" height="26.5" fill="#212121"></rect>
						<rect x="8.2" y="8.3" fill="#<?= $Odontogram->piece(32, 'A1') ?>" width="10" height="10" class="a1"></rect>
						<polygon fill="#<?= $Odontogram->piece(32, 'A2') ?>" points="25.9,25.4 19.1,18.5 19.1,8 26,1.1" class="a2"></polygon>
						<polygon fill="#<?= $Odontogram->piece(32, 'A3') ?>" points="7.4,18.5 0.5,25.4 0.5,1.1 7.4,8" class="a3"></polygon>
						<polygon fill="#<?= $Odontogram->piece(32, 'A4') ?>" points="18.5,7.4 7.9,7.4 1.1,0.5 25.4,0.5" class="a4"></polygon>
						<polygon fill="#<?= $Odontogram->piece(32, 'A5') ?>" points="25.4,26 1.1,26 7.9,19.1 18.5,19.1" class="a5"></polygon>
						<?= $Odontogram->piece(32, 'SVG') ?>
					</svg>
				</div>
				<div class="odntgrm-piece">
					<div><?= $Odontogram->piece(33, 'RH')?></div>
					<span>33</span>
					<svg version="1.0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 26.5 39" data-id="33">
						<rect width="26.5" height="26.5" fill="#212121"></rect>
						<rect x="8.2" y="8.3" fill="#<?= $Odontogram->piece(33, 'A1') ?>" width="10" height="10" class="a1"></rect>
						<polygon fill="#<?= $Odontogram->piece(33, 'A2') ?>" points="25.9,25.4 19.1,18.5 19.1,8 26,1.1" class="a2"></polygon>
						<polygon fill="#<?= $Odontogram->piece(33, 'A3') ?>" points="7.4,18.5 0.5,25.4 0.5,1.1 7.4,8" class="a3"></polygon>
						<polygon fill="#<?= $Odontogram->piece(33, 'A4') ?>" points="18.5,7.4 7.9,7.4 1.1,0.5 25.4,0.5" class="a4"></polygon>
						<polygon fill="#<?= $Odontogram->piece(33, 'A5') ?>" points="25.4,26 1.1,26 7.9,19.1 18.5,19.1" class="a5"></polygon>
						<?= $Odontogram->piece(33, 'SVG') ?>
					</svg>
				</div>
				<div class="odntgrm-piece">
					<div><?= $Odontogram->piece(34, 'RH')?></div>
					<span>34</span>
					<svg version="1.0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 26.5 39" data-id="34">
						<rect width="26.5" height="26.5" fill="#212121"></rect>
						<rect x="8.2" y="8.3" fill="#<?= $Odontogram->piece(34, 'A1') ?>" width="10" height="10" class="a1"></rect>
						<polygon fill="#<?= $Odontogram->piece(34, 'A2') ?>" points="25.9,25.4 19.1,18.5 19.1,8 26,1.1" class="a2"></polygon>
						<polygon fill="#<?= $Odontogram->piece(34, 'A3') ?>" points="7.4,18.5 0.5,25.4 0.5,1.1 7.4,8" class="a3"></polygon>
						<polygon fill="#<?= $Odontogram->piece(34, 'A4') ?>" points="18.5,7.4 7.9,7.4 1.1,0.5 25.4,0.5" class="a4"></polygon>
						<polygon fill="#<?= $Odontogram->piece(34, 'A5') ?>" points="25.4,26 1.1,26 7.9,19.1 18.5,19.1" class="a5"></polygon>
						<?= $Odontogram->piece(34, 'SVG') ?>
					</svg>
				</div>
				<div class="odntgrm-piece">
					<div><?= $Odontogram->piece(35, 'RH')?></div>
					<span>35</span>
					<svg version="1.0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 26.5 39" data-id="35">
						<rect width="26.5" height="26.5" fill="#212121"></rect>
						<rect x="8.2" y="8.3" fill="#<?= $Odontogram->piece(35, 'A1') ?>" width="10" height="10" class="a1"></rect>
						<polygon fill="#<?= $Odontogram->piece(35, 'A2') ?>" points="25.9,25.4 19.1,18.5 19.1,8 26,1.1" class="a2"></polygon>
						<polygon fill="#<?= $Odontogram->piece(35, 'A3') ?>" points="7.4,18.5 0.5,25.4 0.5,1.1 7.4,8" class="a3"></polygon>
						<polygon fill="#<?= $Odontogram->piece(35, 'A4') ?>" points="18.5,7.4 7.9,7.4 1.1,0.5 25.4,0.5" class="a4"></polygon>
						<polygon fill="#<?= $Odontogram->piece(35, 'A5') ?>" points="25.4,26 1.1,26 7.9,19.1 18.5,19.1" class="a5"></polygon>
						<?= $Odontogram->piece(35, 'SVG') ?>
					</svg>
				</div>
				<div class="odntgrm-piece">
					<div><?= $Odontogram->piece(36, 'RH')?></div>
					<span>36</span>
					<svg version="1.0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 26.5 39" data-id="36">
						<rect width="26.5" height="26.5" fill="#212121"></rect>
						<rect x="8.2" y="8.3" fill="#<?= $Odontogram->piece(36, 'A1') ?>" width="10" height="10" class="a1"></rect>
						<polygon fill="#<?= $Odontogram->piece(36, 'A2') ?>" points="25.9,25.4 19.1,18.5 19.1,8 26,1.1" class="a2"></polygon>
						<polygon fill="#<?= $Odontogram->piece(36, 'A3') ?>" points="7.4,18.5 0.5,25.4 0.5,1.1 7.4,8" class="a3"></polygon>
						<polygon fill="#<?= $Odontogram->piece(36, 'A4') ?>" points="18.5,7.4 7.9,7.4 1.1,0.5 25.4,0.5" class="a4"></polygon>
						<polygon fill="#<?= $Odontogram->piece(36, 'A5') ?>" points="25.4,26 1.1,26 7.9,19.1 18.5,19.1" class="a5"></polygon>
						<?= $Odontogram->piece(36, 'SVG') ?>
					</svg>
				</div>
				<div class="odntgrm-piece">
					<div><?= $Odontogram->piece(37, 'RH')?></div>
					<span>37</span>
					<svg version="1.0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 26.5 39" data-id="37">
						<rect width="26.5" height="26.5" fill="#212121"></rect>
						<rect x="8.2" y="8.3" fill="#<?= $Odontogram->piece(37, 'A1') ?>" width="10" height="10" class="a1"></rect>
						<polygon fill="#<?= $Odontogram->piece(37, 'A2') ?>" points="25.9,25.4 19.1,18.5 19.1,8 26,1.1" class="a2"></polygon>
						<polygon fill="#<?= $Odontogram->piece(37, 'A3') ?>" points="7.4,18.5 0.5,25.4 0.5,1.1 7.4,8" class="a3"></polygon>
						<polygon fill="#<?= $Odontogram->piece(37, 'A4') ?>" points="18.5,7.4 7.9,7.4 1.1,0.5 25.4,0.5" class="a4"></polygon>
						<polygon fill="#<?= $Odontogram->piece(37, 'A5') ?>" points="25.4,26 1.1,26 7.9,19.1 18.5,19.1" class="a5"></polygon>
						<?= $Odontogram->piece(37, 'SVG') ?>
					</svg>
				</div>
				<div class="odntgrm-piece">
					<div><?= $Odontogram->piece(38, 'RH')?></div>
					<span>38</span>
					<svg version="1.0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 26.5 39" data-id="38">
						<rect width="26.5" height="26.5" fill="#212121"></rect>
						<rect x="8.2" y="8.3" fill="#<?= $Odontogram->piece(38, 'A1') ?>" width="10" height="10" class="a1"></rect>
						<polygon fill="#<?= $Odontogram->piece(38, 'A2') ?>" points="25.9,25.4 19.1,18.5 19.1,8 26,1.1" class="a2"></polygon>
						<polygon fill="#<?= $Odontogram->piece(38, 'A3') ?>" points="7.4,18.5 0.5,25.4 0.5,1.1 7.4,8" class="a3"></polygon>
						<polygon fill="#<?= $Odontogram->piece(38, 'A4') ?>" points="18.5,7.4 7.9,7.4 1.1,0.5 25.4,0.5" class="a4"></polygon>
						<polygon fill="#<?= $Odontogram->piece(38, 'A5') ?>" points="25.4,26 1.1,26 7.9,19.1 18.5,19.1" class="a5"></polygon>
						<?= $Odontogram->piece(38, 'SVG') ?>
					</svg>
				</div>
			</div>
			<div class="col-xs-6"><!-- MUELAS IZQUIERDA -->
				<div class="odntgrm-controls"><!-- BUTTON ROJO -->
				</div>
				<div class="odntgrm-piece">
					<span>55</span>
					<svg version="1.0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 26.5 30" data-id="55">
						<rect width="26.5" height="26.5" fill="#212121"></rect>
						<rect x="8.2" y="8.3" fill="#<?= $Odontogram->piece(55, 'A1') ?>" width="10" height="10" class="a1"></rect>
						<polygon fill="#<?= $Odontogram->piece(55, 'A2') ?>" points="25.9,25.4 19.1,18.5 19.1,8 26,1.1" class="a2"></polygon>
						<polygon fill="#<?= $Odontogram->piece(55, 'A3') ?>" points="7.4,18.5 0.5,25.4 0.5,1.1 7.4,8" class="a3"></polygon>
						<polygon fill="#<?= $Odontogram->piece(55, 'A4') ?>" points="18.5,7.4 7.9,7.4 1.1,0.5 25.4,0.5" class="a4"></polygon>
						<polygon fill="#<?= $Odontogram->piece(55, 'A5') ?>" points="25.4,26 1.1,26 7.9,19.1 18.5,19.1" class="a5"></polygon>

					</svg>
					<svg version="1.0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 26.5 26.5" data-id="85">
						<rect width="26.5" height="26.5" fill="#212121"></rect>
						<rect x="8.2" y="8.3" fill="#<?= $Odontogram->piece(85, 'A1') ?>" width="10" height="10" class="a1"></rect>
						<polygon fill="#<?= $Odontogram->piece(85, 'A2') ?>" points="25.9,25.4 19.1,18.5 19.1,8 26,1.1" class="a2"></polygon>
						<polygon fill="#<?= $Odontogram->piece(85, 'A3') ?>" points="7.4,18.5 0.5,25.4 0.5,1.1 7.4,8" class="a3"></polygon>
						<polygon fill="#<?= $Odontogram->piece(85, 'A4') ?>" points="18.5,7.4 7.9,7.4 1.1,0.5 25.4,0.5" class="a4"></polygon>
						<polygon fill="#<?= $Odontogram->piece(85, 'A5') ?>" points="25.4,26 1.1,26 7.9,19.1 18.5,19.1" class="a5"></polygon>
					</svg>
					<span>85</span>
				</div>
				<div class="odntgrm-piece">
					<span>54</span>
					<svg version="1.0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 26.5 30" data-id="54">
						<rect width="26.5" height="26.5" fill="#212121"></rect>
						<rect x="8.2" y="8.3" fill="#<?= $Odontogram->piece(54, 'A1') ?>" width="10" height="10" class="a1"></rect>
						<polygon fill="#<?= $Odontogram->piece(54, 'A2') ?>" points="25.9,25.4 19.1,18.5 19.1,8 26,1.1" class="a2"></polygon>
						<polygon fill="#<?= $Odontogram->piece(54, 'A3') ?>" points="7.4,18.5 0.5,25.4 0.5,1.1 7.4,8" class="a3"></polygon>
						<polygon fill="#<?= $Odontogram->piece(54, 'A4') ?>" points="18.5,7.4 7.9,7.4 1.1,0.5 25.4,0.5" class="a4"></polygon>
						<polygon fill="#<?= $Odontogram->piece(54, 'A5') ?>" points="25.4,26 1.1,26 7.9,19.1 18.5,19.1" class="a5"></polygon>
					</svg>
					<svg version="1.0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 26.5 26.5" data-id="84">
						<rect width="26.5" height="26.5" fill="#212121"></rect>
						<rect x="8.2" y="8.3" fill="#<?= $Odontogram->piece(84, 'A1') ?>" width="10" height="10" class="a1"></rect>
						<polygon fill="#<?= $Odontogram->piece(84, 'A2') ?>" points="25.9,25.4 19.1,18.5 19.1,8 26,1.1" class="a2"></polygon>
						<polygon fill="#<?= $Odontogram->piece(84, 'A3') ?>" points="7.4,18.5 0.5,25.4 0.5,1.1 7.4,8" class="a3"></polygon>
						<polygon fill="#<?= $Odontogram->piece(84, 'A4') ?>" points="18.5,7.4 7.9,7.4 1.1,0.5 25.4,0.5" class="a4"></polygon>
						<polygon fill="#<?= $Odontogram->piece(84, 'A5') ?>" points="25.4,26 1.1,26 7.9,19.1 18.5,19.1" class="a5"></polygon>
					</svg>
					<span>84</span>
				</div>
				<div class="odntgrm-piece">
					<span>53</span>
					<svg version="1.0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 26.5 30" data-id="53">
						<rect width="26.5" height="26.5" fill="#212121"></rect>
						<rect x="8.2" y="8.3" fill="#<?= $Odontogram->piece(53, 'A1') ?>" width="10" height="10" class="a1"></rect>
						<polygon fill="#<?= $Odontogram->piece(53, 'A2') ?>" points="25.9,25.4 19.1,18.5 19.1,8 26,1.1" class="a2"></polygon>
						<polygon fill="#<?= $Odontogram->piece(53, 'A3') ?>" points="7.4,18.5 0.5,25.4 0.5,1.1 7.4,8" class="a3"></polygon>
						<polygon fill="#<?= $Odontogram->piece(53, 'A4') ?>" points="18.5,7.4 7.9,7.4 1.1,0.5 25.4,0.5" class="a4"></polygon>
						<polygon fill="#<?= $Odontogram->piece(53, 'A5') ?>" points="25.4,26 1.1,26 7.9,19.1 18.5,19.1" class="a5"></polygon>
					</svg>
					<svg version="1.0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 26.5 26.5" data-id="83">
						<rect width="26.5" height="26.5" fill="#212121"></rect>
						<rect x="8.2" y="8.3" fill="#<?= $Odontogram->piece(83, 'A1') ?>" width="10" height="10" class="a1"></rect>
						<polygon fill="#<?= $Odontogram->piece(83, 'A2') ?>" points="25.9,25.4 19.1,18.5 19.1,8 26,1.1" class="a2"></polygon>
						<polygon fill="#<?= $Odontogram->piece(83, 'A3') ?>" points="7.4,18.5 0.5,25.4 0.5,1.1 7.4,8" class="a3"></polygon>
						<polygon fill="#<?= $Odontogram->piece(83, 'A4') ?>" points="18.5,7.4 7.9,7.4 1.1,0.5 25.4,0.5" class="a4"></polygon>
						<polygon fill="#<?= $Odontogram->piece(83, 'A5') ?>" points="25.4,26 1.1,26 7.9,19.1 18.5,19.1" class="a5"></polygon>
					</svg>
					<span>83</span>
				</div>
				<div class="odntgrm-piece">
					<span>52</span>
					<svg version="1.0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 26.5 30" data-id="52">
						<rect width="26.5" height="26.5" fill="#212121"></rect>
						<rect x="8.2" y="8.3" fill="#<?= $Odontogram->piece(52, 'A1') ?>" width="10" height="10" class="a1"></rect>
						<polygon fill="#<?= $Odontogram->piece(52, 'A2') ?>" points="25.9,25.4 19.1,18.5 19.1,8 26,1.1" class="a2"></polygon>
						<polygon fill="#<?= $Odontogram->piece(52, 'A3') ?>" points="7.4,18.5 0.5,25.4 0.5,1.1 7.4,8" class="a3"></polygon>
						<polygon fill="#<?= $Odontogram->piece(52, 'A4') ?>" points="18.5,7.4 7.9,7.4 1.1,0.5 25.4,0.5" class="a4"></polygon>
						<polygon fill="#<?= $Odontogram->piece(52, 'A5') ?>" points="25.4,26 1.1,26 7.9,19.1 18.5,19.1" class="a5"></polygon>
					</svg>
					<svg version="1.0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 26.5 26.5" data-id="82">
						<rect width="26.5" height="26.5" fill="#212121"></rect>
						<rect x="8.2" y="8.3" fill="#<?= $Odontogram->piece(82, 'A1') ?>" width="10" height="10" class="a1"></rect>
						<polygon fill="#<?= $Odontogram->piece(82, 'A2') ?>" points="25.9,25.4 19.1,18.5 19.1,8 26,1.1" class="a2"></polygon>
						<polygon fill="#<?= $Odontogram->piece(82, 'A3') ?>" points="7.4,18.5 0.5,25.4 0.5,1.1 7.4,8" class="a3"></polygon>
						<polygon fill="#<?= $Odontogram->piece(82, 'A4') ?>" points="18.5,7.4 7.9,7.4 1.1,0.5 25.4,0.5" class="a4"></polygon>
						<polygon fill="#<?= $Odontogram->piece(82, 'A5') ?>" points="25.4,26 1.1,26 7.9,19.1 18.5,19.1" class="a5"></polygon>
					</svg>
					<span>82</span>
				</div>
				<div class="odntgrm-piece">
					<span>51</span>
					<svg version="1.0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 26.5 30" data-id="51">
						<rect width="26.5" height="26.5" fill="#212121"></rect>
						<rect x="8.2" y="8.3" fill="#<?= $Odontogram->piece(51, 'A1') ?>" width="10" height="10" class="a1"></rect>
						<polygon fill="#<?= $Odontogram->piece(51, 'A2') ?>" points="25.9,25.4 19.1,18.5 19.1,8 26,1.1" class="a2"></polygon>
						<polygon fill="#<?= $Odontogram->piece(51, 'A3') ?>" points="7.4,18.5 0.5,25.4 0.5,1.1 7.4,8" class="a3"></polygon>
						<polygon fill="#<?= $Odontogram->piece(51, 'A4') ?>" points="18.5,7.4 7.9,7.4 1.1,0.5 25.4,0.5" class="a4"></polygon>
						<polygon fill="#<?= $Odontogram->piece(51, 'A5') ?>" points="25.4,26 1.1,26 7.9,19.1 18.5,19.1" class="a5"></polygon>
					</svg>
					<svg version="1.0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 26.5 26.5" data-id="81">
						<rect width="26.5" height="26.5" fill="#212121"></rect>
						<rect x="8.2" y="8.3" fill="#<?= $Odontogram->piece(81, 'A1') ?>" width="10" height="10" class="a1"></rect>
						<polygon fill="#<?= $Odontogram->piece(81, 'A2') ?>" points="25.9,25.4 19.1,18.5 19.1,8 26,1.1" class="a2"></polygon>
						<polygon fill="#<?= $Odontogram->piece(81, 'A3') ?>" points="7.4,18.5 0.5,25.4 0.5,1.1 7.4,8" class="a3"></polygon>
						<polygon fill="#<?= $Odontogram->piece(81, 'A4') ?>" points="18.5,7.4 7.9,7.4 1.1,0.5 25.4,0.5" class="a4"></polygon>
						<polygon fill="#<?= $Odontogram->piece(81, 'A5') ?>" points="25.4,26 1.1,26 7.9,19.1 18.5,19.1" class="a5"></polygon>
					</svg>
					<span>81</span>
				</div>
			</div>
			<div class="col-xs-6"><!-- MUELAS DERECHA -->
				<div class="odntgrm-piece">
					<span>61</span>
					<svg version="1.0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 26.5 30" data-id="61">
						<rect width="26.5" height="26.5" fill="#212121"></rect>
						<rect x="8.2" y="8.3" fill="#<?= $Odontogram->piece(61, 'A1') ?>" width="10" height="10" class="a1"></rect>
						<polygon fill="#<?= $Odontogram->piece(61, 'A2') ?>" points="25.9,25.4 19.1,18.5 19.1,8 26,1.1" class="a2"></polygon>
						<polygon fill="#<?= $Odontogram->piece(61, 'A3') ?>" points="7.4,18.5 0.5,25.4 0.5,1.1 7.4,8" class="a3"></polygon>
						<polygon fill="#<?= $Odontogram->piece(61, 'A4') ?>" points="18.5,7.4 7.9,7.4 1.1,0.5 25.4,0.5" class="a4"></polygon>
						<polygon fill="#<?= $Odontogram->piece(61, 'A5') ?>" points="25.4,26 1.1,26 7.9,19.1 18.5,19.1" class="a5"></polygon>
					</svg>
					<svg version="1.0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 26.5 26.5" data-id="71">
						<rect width="26.5" height="26.5" fill="#212121"></rect>
						<rect x="8.2" y="8.3" fill="#<?= $Odontogram->piece(71, 'A1') ?>" width="10" height="10" class="a1"></rect>
						<polygon fill="#<?= $Odontogram->piece(71, 'A2') ?>" points="25.9,25.4 19.1,18.5 19.1,8 26,1.1" class="a2"></polygon>
						<polygon fill="#<?= $Odontogram->piece(71, 'A3') ?>" points="7.4,18.5 0.5,25.4 0.5,1.1 7.4,8" class="a3"></polygon>
						<polygon fill="#<?= $Odontogram->piece(71, 'A4') ?>" points="18.5,7.4 7.9,7.4 1.1,0.5 25.4,0.5" class="a4"></polygon>
						<polygon fill="#<?= $Odontogram->piece(71, 'A5') ?>" points="25.4,26 1.1,26 7.9,19.1 18.5,19.1" class="a5"></polygon>
					</svg>
					<span>71</span>
				</div>
				<div class="odntgrm-piece">
					<span>62</span>
					<svg version="1.0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 26.5 30" data-id="62">
						<rect width="26.5" height="26.5" fill="#212121"></rect>
						<rect x="8.2" y="8.3" fill="#<?= $Odontogram->piece(62, 'A1') ?>" width="10" height="10" class="a1"></rect>
						<polygon fill="#<?= $Odontogram->piece(62, 'A2') ?>" points="25.9,25.4 19.1,18.5 19.1,8 26,1.1" class="a2"></polygon>
						<polygon fill="#<?= $Odontogram->piece(62, 'A3') ?>" points="7.4,18.5 0.5,25.4 0.5,1.1 7.4,8" class="a3"></polygon>
						<polygon fill="#<?= $Odontogram->piece(62, 'A4') ?>" points="18.5,7.4 7.9,7.4 1.1,0.5 25.4,0.5" class="a4"></polygon>
						<polygon fill="#<?= $Odontogram->piece(62, 'A5') ?>" points="25.4,26 1.1,26 7.9,19.1 18.5,19.1" class="a5"></polygon>
					</svg>
					<svg version="1.0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 26.5 26.5" data-id="72">
						<rect width="26.5" height="26.5" fill="#212121"></rect>
						<rect x="8.2" y="8.3" fill="#<?= $Odontogram->piece(72, 'A1') ?>" width="10" height="10" class="a1"></rect>
						<polygon fill="#<?= $Odontogram->piece(72, 'A2') ?>" points="25.9,25.4 19.1,18.5 19.1,8 26,1.1" class="a2"></polygon>
						<polygon fill="#<?= $Odontogram->piece(72, 'A3') ?>" points="7.4,18.5 0.5,25.4 0.5,1.1 7.4,8" class="a3"></polygon>
						<polygon fill="#<?= $Odontogram->piece(72, 'A4') ?>" points="18.5,7.4 7.9,7.4 1.1,0.5 25.4,0.5" class="a4"></polygon>
						<polygon fill="#<?= $Odontogram->piece(72, 'A5') ?>" points="25.4,26 1.1,26 7.9,19.1 18.5,19.1" class="a5"></polygon>
					</svg>
					<span>72</span>
				</div>
				<div class="odntgrm-piece">
					<span>63</span>
					<svg version="1.0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 26.5 30" data-id="63">
						<rect width="26.5" height="26.5" fill="#212121"></rect>
						<rect x="8.2" y="8.3" fill="#<?= $Odontogram->piece(63, 'A1') ?>" width="10" height="10" class="a1"></rect>
						<polygon fill="#<?= $Odontogram->piece(63, 'A2') ?>" points="25.9,25.4 19.1,18.5 19.1,8 26,1.1" class="a2"></polygon>
						<polygon fill="#<?= $Odontogram->piece(63, 'A3') ?>" points="7.4,18.5 0.5,25.4 0.5,1.1 7.4,8" class="a3"></polygon>
						<polygon fill="#<?= $Odontogram->piece(63, 'A4') ?>" points="18.5,7.4 7.9,7.4 1.1,0.5 25.4,0.5" class="a4"></polygon>
						<polygon fill="#<?= $Odontogram->piece(63, 'A5') ?>" points="25.4,26 1.1,26 7.9,19.1 18.5,19.1" class="a5"></polygon>
					</svg>
					<svg version="1.0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 26.5 26.5" data-id="73">
						<rect width="26.5" height="26.5" fill="#212121"></rect>
						<rect x="8.2" y="8.3" fill="#<?= $Odontogram->piece(73, 'A1') ?>" width="10" height="10" class="a1"></rect>
						<polygon fill="#<?= $Odontogram->piece(73, 'A2') ?>" points="25.9,25.4 19.1,18.5 19.1,8 26,1.1" class="a2"></polygon>
						<polygon fill="#<?= $Odontogram->piece(73, 'A3') ?>" points="7.4,18.5 0.5,25.4 0.5,1.1 7.4,8" class="a3"></polygon>
						<polygon fill="#<?= $Odontogram->piece(73, 'A4') ?>" points="18.5,7.4 7.9,7.4 1.1,0.5 25.4,0.5" class="a4"></polygon>
						<polygon fill="#<?= $Odontogram->piece(73, 'A5') ?>" points="25.4,26 1.1,26 7.9,19.1 18.5,19.1" class="a5"></polygon>
					</svg>
					<span>73</span>
				</div>
				<div class="odntgrm-piece">
					<span>64</span>
					<svg version="1.0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 26.5 30" data-id="64">
						<rect width="26.5" height="26.5" fill="#212121"></rect>
						<rect x="8.2" y="8.3" fill="#<?= $Odontogram->piece(64, 'A1') ?>" width="10" height="10" class="a1"></rect>
						<polygon fill="#<?= $Odontogram->piece(64, 'A2') ?>" points="25.9,25.4 19.1,18.5 19.1,8 26,1.1" class="a2"></polygon>
						<polygon fill="#<?= $Odontogram->piece(64, 'A3') ?>" points="7.4,18.5 0.5,25.4 0.5,1.1 7.4,8" class="a3"></polygon>
						<polygon fill="#<?= $Odontogram->piece(64, 'A4') ?>" points="18.5,7.4 7.9,7.4 1.1,0.5 25.4,0.5" class="a4"></polygon>
						<polygon fill="#<?= $Odontogram->piece(64, 'A5') ?>" points="25.4,26 1.1,26 7.9,19.1 18.5,19.1" class="a5"></polygon>
					</svg>
					<svg version="1.0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 26.5 26.5" data-id="74">
						<rect width="26.5" height="26.5" fill="#212121"></rect>
						<rect x="8.2" y="8.3" fill="#<?= $Odontogram->piece(74, 'A1') ?>" width="10" height="10" class="a1"></rect>
						<polygon fill="#<?= $Odontogram->piece(74, 'A2') ?>" points="25.9,25.4 19.1,18.5 19.1,8 26,1.1" class="a2"></polygon>
						<polygon fill="#<?= $Odontogram->piece(74, 'A3') ?>" points="7.4,18.5 0.5,25.4 0.5,1.1 7.4,8" class="a3"></polygon>
						<polygon fill="#<?= $Odontogram->piece(74, 'A4') ?>" points="18.5,7.4 7.9,7.4 1.1,0.5 25.4,0.5" class="a4"></polygon>
						<polygon fill="#<?= $Odontogram->piece(74, 'A5') ?>" points="25.4,26 1.1,26 7.9,19.1 18.5,19.1" class="a5"></polygon>
					</svg>
					<span>74</span>
				</div>
				<div class="odntgrm-piece">
					<span>65</span>
					<svg version="1.0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 26.5 30" data-id="65">
						<rect width="26.5" height="26.5" fill="#212121"></rect>
						<rect x="8.2" y="8.3" fill="#<?= $Odontogram->piece(65, 'A1') ?>" width="10" height="10" class="a1"></rect>
						<polygon fill="#<?= $Odontogram->piece(65, 'A2') ?>" points="25.9,25.4 19.1,18.5 19.1,8 26,1.1" class="a2"></polygon>
						<polygon fill="#<?= $Odontogram->piece(65, 'A3') ?>" points="7.4,18.5 0.5,25.4 0.5,1.1 7.4,8" class="a3"></polygon>
						<polygon fill="#<?= $Odontogram->piece(65, 'A4') ?>" points="18.5,7.4 7.9,7.4 1.1,0.5 25.4,0.5" class="a4"></polygon>
						<polygon fill="#<?= $Odontogram->piece(65, 'A5') ?>" points="25.4,26 1.1,26 7.9,19.1 18.5,19.1" class="a5"></polygon>
					</svg>
					<svg version="1.0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 26.5 26.5" data-id="75">
						<rect width="26.5" height="26.5" fill="#212121"></rect>
						<rect x="8.2" y="8.3" fill="#<?= $Odontogram->piece(75, 'A1') ?>" width="10" height="10" class="a1"></rect>
						<polygon fill="#<?= $Odontogram->piece(75, 'A2') ?>" points="25.9,25.4 19.1,18.5 19.1,8 26,1.1" class="a2"></polygon>
						<polygon fill="#<?= $Odontogram->piece(75, 'A3') ?>" points="7.4,18.5 0.5,25.4 0.5,1.1 7.4,8" class="a3"></polygon>
						<polygon fill="#<?= $Odontogram->piece(75, 'A4') ?>" points="18.5,7.4 7.9,7.4 1.1,0.5 25.4,0.5" class="a4"></polygon>
						<polygon fill="#<?= $Odontogram->piece(75, 'A5') ?>" points="25.4,26 1.1,26 7.9,19.1 18.5,19.1" class="a5"></polygon>
					</svg>
					<span>75</span>
				</div>
				<div class="odntgrm-controls"><!-- BUTTON AZUL -->
				</div>
			</div>
		</div>
	</div>
</div>