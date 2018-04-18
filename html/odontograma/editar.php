<?php
!isset($Patient, $Treatment, $Odontogram) && redirect_exit();
?>
<script>window.odntgrm = <?= json_encode($Odontogram->datos_json) ?></script>
<div class="bar-subtitle">
	<div class="container">
		<a href="<?= $Patient->url() ?>"><?= $Patient->fullname() ?></a>
	</div>
</div>
<div class="bar-btn">
	<div class="container">
		<button class="btn btn-success" onclick="save_odontogram()">GUARDAR</button>
		<a href="<?= $Odontogram->url('ver') ?>" class="btn btn-default">CANCELAR</a>
	</div>
</div>
<div class="container">
	<div class="bar-bordered mt5 mb5">
		<span><?= $Treatment->inicio ?> - <?= $Treatment->estado ?> - <?= $Treatment->tecnica ?></span>
	</div>
	<div class="row odntgrm-wrap">

		<div class="odntgrm">
			<div class="col-xs-6"><!-- SUPERIOR IZQUIERDA -->
				<div class="odntgrm-piece">
					<select class="selectpicker show-menu-arrow show-tick form-control" onchange="set_odontogram(18, 'RH', this.value)" tabindex="-98">
						<option>Seleccione..</option>
						<option value="I" <?= $Odontogram->piece(18, 'RH') == 'I' ? 'selected="true"' : '' ?>>I</option>
						<option value="TC" <?= $Odontogram->piece(18, 'RH') == 'TC' ? 'selected="true"' : '' ?>>TC</option>
						<option value="H" <?= $Odontogram->piece(18, 'RH') == 'H' ? 'selected="true"' : '' ?>>H</option>
					</select>
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
					<select class="selectpicker show-menu-arrow show-tick form-control" onchange="set_odontogram(17, 'RH', this.value)" tabindex="-98">
						<option>Seleccione..</option>
						<option value="I" <?= $Odontogram->piece(17, 'RH') == 'I' ? 'selected="true"' : '' ?>>I</option>
						<option value="TC" <?= $Odontogram->piece(17, 'RH') == 'TC' ? 'selected="true"' : '' ?>>TC</option>
						<option value="H" <?= $Odontogram->piece(17, 'RH') == 'H' ? 'selected="true"' : '' ?>>H</option>
					</select>
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
					<select class="selectpicker show-menu-arrow show-tick form-control" onchange="set_odontogram(16, 'RH', this.value)" tabindex="-98">
						<option>Seleccione..</option>
						<option value="I" <?= $Odontogram->piece(16, 'RH') == 'I' ? 'selected="true"' : '' ?>>I</option>
						<option value="TC" <?= $Odontogram->piece(16, 'RH') == 'TC' ? 'selected="true"' : '' ?>>TC</option>
						<option value="H" <?= $Odontogram->piece(16, 'RH') == 'H' ? 'selected="true"' : '' ?>>H</option>
					</select>
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
					<select class="selectpicker show-menu-arrow show-tick form-control" onchange="set_odontogram(15, 'RH', this.value)" tabindex="-98">
						<option>Seleccione..</option>
						<option value="I" <?= $Odontogram->piece(15, 'RH') == 'I' ? 'selected="true"' : '' ?>>I</option>
						<option value="TC" <?= $Odontogram->piece(15, 'RH') == 'TC' ? 'selected="true"' : '' ?>>TC</option>
						<option value="H" <?= $Odontogram->piece(15, 'RH') == 'H' ? 'selected="true"' : '' ?>>H</option>
					</select>
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
					<select class="selectpicker show-menu-arrow show-tick form-control" onchange="set_odontogram(14, 'RH', this.value)" tabindex="-98">
						<option>Seleccione..</option>
						<option value="I" <?= $Odontogram->piece(14, 'RH') == 'I' ? 'selected="true"' : '' ?>>I</option>
						<option value="TC" <?= $Odontogram->piece(14, 'RH') == 'TC' ? 'selected="true"' : '' ?>>TC</option>
						<option value="H" <?= $Odontogram->piece(14, 'RH') == 'H' ? 'selected="true"' : '' ?>>H</option>
					</select>
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
					<select class="selectpicker show-menu-arrow show-tick form-control" onchange="set_odontogram(13, 'RH', this.value)" tabindex="-98">
						<option>Seleccione..</option>
						<option value="I" <?= $Odontogram->piece(13, 'RH') == 'I' ? 'selected="true"' : '' ?>>I</option>
						<option value="TC" <?= $Odontogram->piece(13, 'RH') == 'TC' ? 'selected="true"' : '' ?>>TC</option>
						<option value="H" <?= $Odontogram->piece(13, 'RH') == 'H' ? 'selected="true"' : '' ?>>H</option>
					</select>
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
					<select class="selectpicker show-menu-arrow show-tick form-control" onchange="set_odontogram(12, 'RH', this.value)" tabindex="-98">
						<option>Seleccione..</option>
						<option value="I" <?= $Odontogram->piece(12, 'RH') == 'I' ? 'selected="true"' : '' ?>>I</option>
						<option value="TC" <?= $Odontogram->piece(12, 'RH') == 'TC' ? 'selected="true"' : '' ?>>TC</option>
						<option value="H" <?= $Odontogram->piece(12, 'RH') == 'H' ? 'selected="true"' : '' ?>>H</option>
					</select>
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
					<select class="selectpicker show-menu-arrow show-tick form-control" onchange="set_odontogram(11, 'RH', this.value)" tabindex="-98">
						<option>Seleccione..</option>
						<option value="I" <?= $Odontogram->piece(11, 'RH') == 'I' ? 'selected="true"' : '' ?>>I</option>
						<option value="TC" <?= $Odontogram->piece(11, 'RH') == 'TC' ? 'selected="true"' : '' ?>>TC</option>
						<option value="H" <?= $Odontogram->piece(11, 'RH') == 'H' ? 'selected="true"' : '' ?>>H</option>
					</select>
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
					<select class="selectpicker show-menu-arrow show-tick form-control" onchange="set_odontogram(21, 'RH', this.value)" tabindex="-98">
						<option>Seleccione..</option>
						<option value="I" <?= $Odontogram->piece(21, 'RH') == 'I' ? 'selected="true"' : '' ?>>I</option>
						<option value="TC" <?= $Odontogram->piece(21, 'RH') == 'TC' ? 'selected="true"' : '' ?>>TC</option>
						<option value="H" <?= $Odontogram->piece(21, 'RH') == 'H' ? 'selected="true"' : '' ?>>H</option>
					</select>
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
					<select class="selectpicker show-menu-arrow show-tick form-control" onchange="set_odontogram(22, 'RH', this.value)" tabindex="-98">
						<option>Seleccione..</option>
						<option value="I" <?= $Odontogram->piece(22, 'RH') == 'I' ? 'selected="true"' : '' ?>>I</option>
						<option value="TC" <?= $Odontogram->piece(22, 'RH') == 'TC' ? 'selected="true"' : '' ?>>TC</option>
						<option value="H" <?= $Odontogram->piece(22, 'RH') == 'H' ? 'selected="true"' : '' ?>>H</option>
					</select>
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
					<select class="selectpicker show-menu-arrow show-tick form-control" onchange="set_odontogram(23, 'RH', this.value)" tabindex="-98">
						<option>Seleccione..</option>
						<option value="I" <?= $Odontogram->piece(23, 'RH') == 'I' ? 'selected="true"' : '' ?>>I</option>
						<option value="TC" <?= $Odontogram->piece(23, 'RH') == 'TC' ? 'selected="true"' : '' ?>>TC</option>
						<option value="H" <?= $Odontogram->piece(23, 'RH') == 'H' ? 'selected="true"' : '' ?>>H</option>
					</select>
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
					<select class="selectpicker show-menu-arrow show-tick form-control" onchange="set_odontogram(24, 'RH', this.value)" tabindex="-98">
						<option>Seleccione..</option>
						<option value="I" <?= $Odontogram->piece(24, 'RH') == 'I' ? 'selected="true"' : '' ?>>I</option>
						<option value="TC" <?= $Odontogram->piece(24, 'RH') == 'TC' ? 'selected="true"' : '' ?>>TC</option>
						<option value="H" <?= $Odontogram->piece(24, 'RH') == 'H' ? 'selected="true"' : '' ?>>H</option>
					</select>
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
					<select class="selectpicker show-menu-arrow show-tick form-control" onchange="set_odontogram(25, 'RH', this.value)" tabindex="-98">
						<option>Seleccione..</option>
						<option value="I" <?= $Odontogram->piece(25, 'RH') == 'I' ? 'selected="true"' : '' ?>>I</option>
						<option value="TC" <?= $Odontogram->piece(25, 'RH') == 'TC' ? 'selected="true"' : '' ?>>TC</option>
						<option value="H" <?= $Odontogram->piece(25, 'RH') == 'H' ? 'selected="true"' : '' ?>>H</option>
					</select>
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
					<select class="selectpicker show-menu-arrow show-tick form-control" onchange="set_odontogram(26, 'RH', this.value)" tabindex="-98">
						<option>Seleccione..</option>
						<option value="I" <?= $Odontogram->piece(26, 'RH') == 'I' ? 'selected="true"' : '' ?>>I</option>
						<option value="TC" <?= $Odontogram->piece(26, 'RH') == 'TC' ? 'selected="true"' : '' ?>>TC</option>
						<option value="H" <?= $Odontogram->piece(26, 'RH') == 'H' ? 'selected="true"' : '' ?>>H</option>
					</select>
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
					<select class="selectpicker show-menu-arrow show-tick form-control" onchange="set_odontogram(27, 'RH', this.value)" tabindex="-98">
						<option>Seleccione..</option>
						<option value="I" <?= $Odontogram->piece(27, 'RH') == 'I' ? 'selected="true"' : '' ?>>I</option>
						<option value="TC" <?= $Odontogram->piece(27, 'RH') == 'TC' ? 'selected="true"' : '' ?>>TC</option>
						<option value="H" <?= $Odontogram->piece(27, 'RH') == 'H' ? 'selected="true"' : '' ?>>H</option>
					</select>
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
					<select class="selectpicker show-menu-arrow show-tick form-control" onchange="set_odontogram(28, 'RH', this.value)" tabindex="-98">
						<option>Seleccione..</option>
						<option value="I" <?= $Odontogram->piece(28, 'RH') == 'I' ? 'selected="true"' : '' ?>>I</option>
						<option value="TC" <?= $Odontogram->piece(28, 'RH') == 'TC' ? 'selected="true"' : '' ?>>TC</option>
						<option value="H" <?= $Odontogram->piece(28, 'RH') == 'H' ? 'selected="true"' : '' ?>>H</option>
					</select>
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
					<select class="selectpicker show-menu-arrow show-tick form-control" onchange="set_odontogram(48, 'RH', this.value)" tabindex="-98">
						<option>Seleccione..</option>
						<option value="I" <?= $Odontogram->piece(48, 'RH') == 'I' ? 'selected="true"' : '' ?>>I</option>
						<option value="TC" <?= $Odontogram->piece(48, 'RH') == 'TC' ? 'selected="true"' : '' ?>>TC</option>
						<option value="H" <?= $Odontogram->piece(48, 'RH') == 'H' ? 'selected="true"' : '' ?>>H</option>
					</select>
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
					<select class="selectpicker show-menu-arrow show-tick form-control" onchange="set_odontogram(47, 'RH', this.value)" tabindex="-98">
						<option>Seleccione..</option>
						<option value="I" <?= $Odontogram->piece(47, 'RH') == 'I' ? 'selected="true"' : '' ?>>I</option>
						<option value="TC" <?= $Odontogram->piece(47, 'RH') == 'TC' ? 'selected="true"' : '' ?>>TC</option>
						<option value="H" <?= $Odontogram->piece(47, 'RH') == 'H' ? 'selected="true"' : '' ?>>H</option>
					</select>
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
					<select class="selectpicker show-menu-arrow show-tick form-control" onchange="set_odontogram(46, 'RH', this.value)" tabindex="-98">
						<option>Seleccione..</option>
						<option value="I" <?= $Odontogram->piece(46, 'RH') == 'I' ? 'selected="true"' : '' ?>>I</option>
						<option value="TC" <?= $Odontogram->piece(46, 'RH') == 'TC' ? 'selected="true"' : '' ?>>TC</option>
						<option value="H" <?= $Odontogram->piece(46, 'RH') == 'H' ? 'selected="true"' : '' ?>>H</option>
					</select>
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
					<select class="selectpicker show-menu-arrow show-tick form-control" onchange="set_odontogram(45, 'RH', this.value)" tabindex="-98">
						<option>Seleccione..</option>
						<option value="I" <?= $Odontogram->piece(45, 'RH') == 'I' ? 'selected="true"' : '' ?>>I</option>
						<option value="TC" <?= $Odontogram->piece(45, 'RH') == 'TC' ? 'selected="true"' : '' ?>>TC</option>
						<option value="H" <?= $Odontogram->piece(45, 'RH') == 'H' ? 'selected="true"' : '' ?>>H</option>
					</select>
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
					<select class="selectpicker show-menu-arrow show-tick form-control" onchange="set_odontogram(44, 'RH', this.value)" tabindex="-98">
						<option>Seleccione..</option>
						<option value="I" <?= $Odontogram->piece(44, 'RH') == 'I' ? 'selected="true"' : '' ?>>I</option>
						<option value="TC" <?= $Odontogram->piece(44, 'RH') == 'TC' ? 'selected="true"' : '' ?>>TC</option>
						<option value="H" <?= $Odontogram->piece(44, 'RH') == 'H' ? 'selected="true"' : '' ?>>H</option>
					</select>
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
					<select class="selectpicker show-menu-arrow show-tick form-control" onchange="set_odontogram(43, 'RH', this.value)" tabindex="-98">
						<option>Seleccione..</option>
						<option value="I" <?= $Odontogram->piece(43, 'RH') == 'I' ? 'selected="true"' : '' ?>>I</option>
						<option value="TC" <?= $Odontogram->piece(43, 'RH') == 'TC' ? 'selected="true"' : '' ?>>TC</option>
						<option value="H" <?= $Odontogram->piece(43, 'RH') == 'H' ? 'selected="true"' : '' ?>>H</option>
					</select>
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
					<select class="selectpicker show-menu-arrow show-tick form-control" onchange="set_odontogram(42, 'RH', this.value)" tabindex="-98">
						<option>Seleccione..</option>
						<option value="I" <?= $Odontogram->piece(42, 'RH') == 'I' ? 'selected="true"' : '' ?>>I</option>
						<option value="TC" <?= $Odontogram->piece(42, 'RH') == 'TC' ? 'selected="true"' : '' ?>>TC</option>
						<option value="H" <?= $Odontogram->piece(42, 'RH') == 'H' ? 'selected="true"' : '' ?>>H</option>
					</select>
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
					<select class="selectpicker show-menu-arrow show-tick form-control" onchange="set_odontogram(41, 'RH', this.value)" tabindex="-98">
						<option>Seleccione..</option>
						<option value="I" <?= $Odontogram->piece(41, 'RH') == 'I' ? 'selected="true"' : '' ?>>I</option>
						<option value="TC" <?= $Odontogram->piece(41, 'RH') == 'TC' ? 'selected="true"' : '' ?>>TC</option>
						<option value="H" <?= $Odontogram->piece(41, 'RH') == 'H' ? 'selected="true"' : '' ?>>H</option>
					</select>
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
					<select class="selectpicker show-menu-arrow show-tick form-control" onchange="set_odontogram(31, 'RH', this.value)" tabindex="-98">
						<option>Seleccione..</option>
						<option value="I" <?= $Odontogram->piece(31, 'RH') == 'I' ? 'selected="true"' : '' ?>>I</option>
						<option value="TC" <?= $Odontogram->piece(31, 'RH') == 'TC' ? 'selected="true"' : '' ?>>TC</option>
						<option value="H" <?= $Odontogram->piece(31, 'RH') == 'H' ? 'selected="true"' : '' ?>>H</option>
					</select>
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
					<select class="selectpicker show-menu-arrow show-tick form-control" onchange="set_odontogram(32, 'RH', this.value)" tabindex="-98">
						<option>Seleccione..</option>
						<option value="I" <?= $Odontogram->piece(32, 'RH') == 'I' ? 'selected="true"' : '' ?>>I</option>
						<option value="TC" <?= $Odontogram->piece(32, 'RH') == 'TC' ? 'selected="true"' : '' ?>>TC</option>
						<option value="H" <?= $Odontogram->piece(32, 'RH') == 'H' ? 'selected="true"' : '' ?>>H</option>
					</select>
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
					<select class="selectpicker show-menu-arrow show-tick form-control" onchange="set_odontogram(33, 'RH', this.value)" tabindex="-98">
						<option>Seleccione..</option>
						<option value="I" <?= $Odontogram->piece(33, 'RH') == 'I' ? 'selected="true"' : '' ?>>I</option>
						<option value="TC" <?= $Odontogram->piece(33, 'RH') == 'TC' ? 'selected="true"' : '' ?>>TC</option>
						<option value="H" <?= $Odontogram->piece(33, 'RH') == 'H' ? 'selected="true"' : '' ?>>H</option>
					</select>
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
					<select class="selectpicker show-menu-arrow show-tick form-control" onchange="set_odontogram(34, 'RH', this.value)" tabindex="-98">
						<option>Seleccione..</option>
						<option value="I" <?= $Odontogram->piece(34, 'RH') == 'I' ? 'selected="true"' : '' ?>>I</option>
						<option value="TC" <?= $Odontogram->piece(34, 'RH') == 'TC' ? 'selected="true"' : '' ?>>TC</option>
						<option value="H" <?= $Odontogram->piece(34, 'RH') == 'H' ? 'selected="true"' : '' ?>>H</option>
					</select>
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
					<select class="selectpicker show-menu-arrow show-tick form-control" onchange="set_odontogram(35, 'RH', this.value)" tabindex="-98">
						<option>Seleccione..</option>
						<option value="I" <?= $Odontogram->piece(35, 'RH') == 'I' ? 'selected="true"' : '' ?>>I</option>
						<option value="TC" <?= $Odontogram->piece(35, 'RH') == 'TC' ? 'selected="true"' : '' ?>>TC</option>
						<option value="H" <?= $Odontogram->piece(35, 'RH') == 'H' ? 'selected="true"' : '' ?>>H</option>
					</select>
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
					<select class="selectpicker show-menu-arrow show-tick form-control" onchange="set_odontogram(36, 'RH', this.value)" tabindex="-98">
						<option>Seleccione..</option>
						<option value="I" <?= $Odontogram->piece(36, 'RH') == 'I' ? 'selected="true"' : '' ?>>I</option>
						<option value="TC" <?= $Odontogram->piece(36, 'RH') == 'TC' ? 'selected="true"' : '' ?>>TC</option>
						<option value="H" <?= $Odontogram->piece(36, 'RH') == 'H' ? 'selected="true"' : '' ?>>H</option>
					</select>
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
					<select class="selectpicker show-menu-arrow show-tick form-control" onchange="set_odontogram(37, 'RH', this.value)" tabindex="-98">
						<option>Seleccione..</option>
						<option value="I" <?= $Odontogram->piece(37, 'RH') == 'I' ? 'selected="true"' : '' ?>>I</option>
						<option value="TC" <?= $Odontogram->piece(37, 'RH') == 'TC' ? 'selected="true"' : '' ?>>TC</option>
						<option value="H" <?= $Odontogram->piece(37, 'RH') == 'H' ? 'selected="true"' : '' ?>>H</option>
					</select>
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
					<select class="selectpicker show-menu-arrow show-tick form-control" onchange="set_odontogram(38, 'RH', this.value)" tabindex="-98">
						<option>Seleccione..</option>
						<option value="I" <?= $Odontogram->piece(38, 'RH') == 'I' ? 'selected="true"' : '' ?>>I</option>
						<option value="TC" <?= $Odontogram->piece(38, 'RH') == 'TC' ? 'selected="true"' : '' ?>>TC</option>
						<option value="H" <?= $Odontogram->piece(38, 'RH') == 'H' ? 'selected="true"' : '' ?>>H</option>
					</select>
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
				<div class="odntgrm-controls"><!-- BUTTON AZUL -->
					<svg version="1.0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 80.3 80.3" enable-background="new 0 0 80.3 80.3" xml:space="preserve">
						<g>
							<rect width="80.3" height="80.3"></rect>
							<rect x="25" y="25" fill="#E11" width="30.3" height="30.3" onclick="fill_.call(this, 'a1_e11')"></rect>
							<polygon fill="#E11" points="78.7,77.1 57.8,56.2 57.8,24.1 78.7,3.2" onclick="fill_.call(this, 'a2_e11')"></polygon>
							<polygon fill="#E11" points="22.5,56.2 1.6,77.1 1.6,3.2 22.5,24.1" onclick="fill_.call(this, 'a3_e11')"></polygon>
							<polygon fill="#E11" points="56.2,22.5 24.1,22.5 3.2,1.6 77,1.6" onclick="fill_.call(this, 'a4_e11')"></polygon>
							<polygon fill="#E11" points="77,78.7 3.2,78.7 24.1,57.9 56.2,57.9" onclick="fill_.call(this, 'a5_e11')"></polygon>
						</g>
					</svg>
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
					<svg version="1.0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 80.3 80.3" enable-background="new 0 0 80.3 80.3" xml:space="preserve">
						<g>
							<rect width="80.3" height="80.3" fill="#212121"></rect>
							<rect x="25" y="25" fill="#3AF" width="30.3" height="30.3" onclick="fill_.call(this, 'a1_3af')"></rect>
							<polygon fill="#3AF" points="78.7,77.1 57.8,56.2 57.8,24.1 78.7,3.2" onclick="fill_.call(this, 'a2_3af')"></polygon>
							<polygon fill="#3AF" points="22.5,56.2 1.6,77.1 1.6,3.2 22.5,24.1" onclick="fill_.call(this, 'a3_3af')"></polygon>
							<polygon fill="#3AF" points="56.2,22.5 24.1,22.5 3.2,1.6 77,1.6" onclick="fill_.call(this, 'a4_3af')"></polygon>
							<polygon fill="#3AF" points="77,78.7 3.2,78.7 24.1,57.9 56.2,57.9" onclick="fill_.call(this, 'a5_3af')"></polygon>
						</g>
					</svg>
				</div>
			</div>
		</div>

	</div>
</div>
<div class="container">
	<div class="odntgrm-btn-wrap">
		<button class="odntgrm-btn btn" onclick="btn_.call(this, 'o_e11')">
			<img src="<?= URL_ROOT ?>/img/res/button_1.png" class="img-responsive center-block">
		</button>
	</div>
	<div class="odntgrm-btn-wrap">
		<button class="odntgrm-btn btn" onclick="btn_.call(this, 'o_3af')">
			<img src="<?= URL_ROOT ?>/img/res/button_2.png" class="img-responsive center-block">
		</button>
	</div>
	<div class="odntgrm-btn-wrap">
		<button class="odntgrm-btn btn" onclick="btn_.call(this, 'x_e11')">
			<img src="<?= URL_ROOT ?>/img/res/button_3.png" class="img-responsive center-block">
		</button>
	</div>
	<div class="odntgrm-btn-wrap">
		<button class="odntgrm-btn btn" onclick="btn_.call(this, 'x_3af')">
			<img src="<?= URL_ROOT ?>/img/res/button_4.png" class="img-responsive center-block">
		</button>
	</div>
	<div class="odntgrm-btn-wrap">
		<button class="odntgrm-btn btn" onclick="btn_.call(this, 'd_e11')">
			<img src="<?= URL_ROOT ?>/img/res/button_5.png" class="img-responsive center-block">
		</button>
	</div>
	<div class="odntgrm-btn-wrap">
		<button class="odntgrm-btn btn" onclick="btn_.call(this, 's_3af')">
			<img src="<?= URL_ROOT ?>/img/res/button_6.png" class="img-responsive center-block">
		</button>
	</div>
	<div class="odntgrm-btn-wrap">
		<button class="odntgrm-btn btn" onclick="btn_.call(this, 'bs1_e11')">
			<img src="<?= URL_ROOT ?>/img/res/button_7.png" class="img-responsive center-block">
		</button>
	</div>
	<div class="odntgrm-btn-wrap">
		<button class="odntgrm-btn btn" onclick="btn_.call(this, 'bs2_e11')">
			<img src="<?= URL_ROOT ?>/img/res/button_8.png" class="img-responsive center-block">
		</button>
	</div>
	<div class="odntgrm-btn-wrap">
		<button class="odntgrm-btn btn" onclick="btn_.call(this, 'bs3_e11')">
			<img src="<?= URL_ROOT ?>/img/res/button_9.png" class="img-responsive center-block">
		</button>
	</div>
	<div class="odntgrm-btn-wrap">
		<button class="odntgrm-btn btn" onclick="btn_.call(this, 'bs1_3af')">
			<img src="<?= URL_ROOT ?>/img/res/button_10.png" class="img-responsive center-block">
		</button>
	</div>
	<div class="odntgrm-btn-wrap">
		<button class="odntgrm-btn btn" onclick="btn_.call(this, 'bs2_3af')">
			<img src="<?= URL_ROOT ?>/img/res/button_11.png" class="img-responsive center-block">
		</button>
	</div>
	<div class="odntgrm-btn-wrap">
		<button class="odntgrm-btn btn" onclick="btn_.call(this, 'bs3_3af')">
			<img src="<?= URL_ROOT ?>/img/res/button_12.png" class="img-responsive center-block">
		</button>
	</div>
	<div class="odntgrm-btn-wrap">
		<button class="odntgrm-btn btn" onclick="btn_.call(this, 'bd1_e11')">
			<img src="<?= URL_ROOT ?>/img/res/button_13.png" class="img-responsive center-block">
		</button>
	</div>
	<div class="odntgrm-btn-wrap">
		<button class="odntgrm-btn btn" onclick="btn_.call(this, 'bd2_e11')">
			<img src="<?= URL_ROOT ?>/img/res/button_14.png" class="img-responsive center-block">
		</button>
	</div>
	<div class="odntgrm-btn-wrap">
		<button class="odntgrm-btn btn" onclick="btn_.call(this, 'bd3_e11')">
			<img src="<?= URL_ROOT ?>/img/res/button_15.png" class="img-responsive center-block">
		</button>
	</div>
	<div class="odntgrm-btn-wrap">
		<button class="odntgrm-btn btn" onclick="btn_.call(this, 'bd1_3af')">
			<img src="<?= URL_ROOT ?>/img/res/button_16.png" class="img-responsive center-block">
		</button>
	</div>
	<div class="odntgrm-btn-wrap">
		<button class="odntgrm-btn btn" onclick="btn_.call(this, 'bd2_3af')">
			<img src="<?= URL_ROOT ?>/img/res/button_17.png" class="img-responsive center-block">
		</button>
	</div>
	<div class="odntgrm-btn-wrap">
		<button class="odntgrm-btn btn" onclick="btn_.call(this, 'bd3_3af')">
			<img src="<?= URL_ROOT ?>/img/res/button_18.png" class="img-responsive center-block">
		</button>
	</div>
</div>

