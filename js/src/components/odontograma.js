if(window.odntgrm){

	function is(a, b) {
		if (typeof a === 'undefined') {
			return false;
		}

		if (typeof a == 'string' && typeof b == 'undefined') {
			b = a;
			a = this;
		}

		if (typeof a.constructor.name !== 'undefined' && a.constructor.name.toLowerCase() === b.toLowerCase()) {
			return true;
		}

		return false;
	}



	function isElement(a) {

		if (typeof a !== 'object' || a == null) {
			return false;

		}
		else if (typeof a.nodeType !== 'undefined') {
			if (a.nodeType == 1) {
				return true;
			}
		}

		return false;
	}

	function each(obj, callback) 
	{
		var length, i = 0,
		length = obj.length;

		if (is(obj, 'array') || length === 0 || is(length, 'number') && length > 0 && (length - 1) in obj) {
			for (; i < length; i++) {
				if (callback.call(obj[i], i, obj[i]) === false) {
					break;
				}
			}
		}
		else {
			for (i in obj) {
				if (callback.call(obj[i], i, obj[i]) === false) {
					break;
				}
			}
		}

		return obj;
	}


	window.fill_ = function(data) 
	{
		var	_ = this;

		var pieces = document.querySelectorAll('.odntgrm-piece svg');

		each(pieces, function(a,b) {
			b.classList.remove('___active___');
		});

		_.classList.add('___active___');

		each(pieces, function(a,b) {
			b.onclick = () => {

				if (data){
					var p = this.getAttribute('data-id'),
					args = is(data, 'array') ? data : data.split('_');

					if(odontogram.isset(p, 'SUP', data)){
						this.getElementsByClassName(args[0])[0].setAttributeNS(null, 'fill', '#FFF');

						odontogram.unset(p, 'SUP', data);

						_.classList.remove('___active___');

						data = false;

						return true;
					}

					if(!odontogram.set(p, 'SUP', data)) {
						return false;
					}

					if (this.getElementsByClassName('SUP')[0]){
						this.removeChild(this.getElementsByClassName('SUP')[0]);
					}

					this.getElementsByClassName(args[0])[0].setAttributeNS(null, 'fill', '#' + args[1]);

					_.classList.remove('___active___');

					data = false;
				}
			}
		});
	};


	window.btn_ = function(data)
	{
		var	_ = this;

		each(document.querySelectorAll('.odntgrm-piece svg'), function(a,b) {
			b.classList.remove('___active___');
		});

		_.classList.add('___active___');

		each(document.querySelectorAll('svg'), function() {
			this.onclick = () => {


				if (data){
					var m ,
					p = this.getAttribute('data-id'),
					args = is(data, 'array') ? data : data.split('_');


					if (!((m = /^[oxds]$/i.exec(args[0])) == null && p >= 51)) {
						var c = m ? 'SUP' : 'INF',
						g = this.getElementsByClassName(c)[0];


						if(odontogram.isset(p, c, data)){
							if (g) {
								while (g.firstChild) {
									g.removeChild(g.firstChild);
								}
							}


							odontogram.unset(p, c, data);


							_.classList.remove('___active___');


							data = false;


							return true;
						}


						if(!odontogram.set(p, c, data)) {
							return false;
						}


						if (g) {
							while (g.firstChild) {
								g.removeChild(g.firstChild);
							}
						}
						else{
							g = document.createElementNS('http://www.w3.org/2000/svg','g');
						}


						if (c == 'SUP') {
							this.querySelectorAll('.a1,.a2,.a3,.a4,.a5').forEach(function(a){
								a.setAttributeNS(null, 'fill','#FFF');
							});
						}


						g.setAttributeNS(null, 'class', c);


						paths[args[0]].forEach(function(a){


							var f =  document.createElementNS('http://www.w3.org/2000/svg',a.shape);


							a.fill = '#' + args[1];


							for(k in a){
								if (k !== 'shape') {
									f.setAttributeNS(null, k, a[k]);
								}
							}


							g.appendChild(f);
						});


						this.appendChild(g);


						_.classList.remove('___active___');


						data = false;
					}
				}
			}
		});
	};


	Odontogram = function(json) {
		var _ = this;
		each(window.odntgrm, function(index, el) {
			_[index] = el;
		});
	}


	Odontogram.prototype = {
		set : function (id, area, data) {
			console.log(this);


			if (!/^(SUP|INF|RH)$/i.test(area) || !/^((a[1-5]|[oxsd]|b[ds][1-3])_(e11|3af)|[IH]|TC)$/i.test(data) || (id = /^P_(?:[1-4][1-8]|[5-8][1-5])$/i.exec('P_' + id)) == null || (id > 50 && area != 'SUP')) {
				return false;
			}


			this[id[0]] = this[id[0]] || {[area] : []};


			if (/^(SUP([oxsd])|INFb[ds][1-3])_(e11|3af)|RH([IH]|TC)$/i.test(area + data)) {
				this[id[0]][area] = data;
				return true;
			}
			else if (/^SUPa[1-5]_(e11|3af)$/i.test(area + data)) {


				this[id[0]].SUP = this[id[0]].SUP || [];


				if (is(this[id[0]].SUP, 'string')) {
					this[id[0]].SUP = [data];
					return true;
				}
				else if(this[id[0]].SUP.indexOf(data) == -1){
					this[id[0]].SUP.push(data);
					return true;
				}
			}
			else{
				return false;
			}
		},
		isset : function(id, area, data){


			if (typeof this['P_' + id] != 'undefined') {
				if (typeof this['P_' + id][area] != 'undefined') {
					if (this['P_' + id][area].indexOf(data) != -1) {
						return true;
					}
				}
			}


			return false;
		},
		unset : function(id, area, data){
			var _ = this['P_' + id];


			if (/^(SUP([oxsd])|INFb[ds][1-3])_(e11|3af)|RH([IH]|TC)$/i.test(area + data)) {
				delete _[area];
			}
			else if (/^SUPa[1-5]_(e11|3af)$/i.test(area + data)) {


				_.SUP.splice(this['P_' + id].SUP.indexOf(data), 1);


				if (_.SUP.length == 0) {
					delete _.SUP;
				}
			}


			if (Object.keys(_).length == 0) {
				delete this['P_' + id];
			}


			return false;
		},
		send : function(){
			console.log(this);

			var uid = "__" + ('' + Math.random()).replace(/\D/g, '');


			document.body.appendChild((function(document, _, id){
				var f = document.createElement('form');
				f.method = 'POST';
				f.id = id;
				f.action = window.location.href ;
				f.appendChild(document.createElement('input')); 
				f[0].name = 'json';
				f[0].value =JSON.stringify(_);
				return f;
			})(document, this, uid));


			document.getElementById(uid).submit();
		}
	};

	var odontogram = new Odontogram();

	window.save_odontogram = () => odontogram.send();
	window.set_odontogram = (id, area, data) => odontogram.set(id, area, data);

	var paths = {
		o : [{
			shape : 'path',
			d : 'M22.2,13.3c0,5-4,9-9,9s-9-4-9-9s4-9,9-9S22.2,8.3,22.2,13.3z M13.2,2.4c-6,0-10.9,4.9-10.9,10.9s4.9,10.9,10.9,10.9s10.9-4.9,10.9-10.9S19.2,2.4,13.2,2.4z'
		}],
		x : [{
			shape : 'path',
			d : 'M15.3,13.3l8.4-8.4c0.6-0.6,0.6-1.5,0-2.1c-0.6-0.6-1.5-0.6-2.1,0l-8.4,8.4L4.8,2.8c-0.6-0.6-1.5-0.6-2.1,0c-0.6,0.6-0.6,1.5,0,2.1l8.4,8.4l-8.4,8.4c-0.6,0.6-0.6,1.5,0,2.1c0.6,0.6,1.5,0.6,2.1,0l8.4-8.3l8.4,8.3c0.6,0.6,1.5,0.6,2.1,0c0.6-0.6,0.6-1.5,0-2.1L15.3,13.3z'
		}],
		d : [{
			shape : 'rect',
			y : 5.6,
			width : 26.5,
			height : 6.2
		},
		{
			shape : 'rect',
			y : 14.7,
			width : 26.5,
			height : 6.2
		}],
		s : [{
			shape : 'rect',
			y : 10.1,
			width : 26.5,
			height : 6.2
		}],
		bd1 : [{
			shape : 'path',
			d : 'M26.2,39.3H11.6V28.7h1.9v8.8h12.7V39.3z'
		},
		{
			shape : 'path',
			d : 'M26.2,36.3H15.7v-7.6h1.9v5.8h8.7L26.2,36.3L26.2,36.3z'
		}],
		bd2 : [{
			shape : 'rect',
			y : 37.4,
			width : 26.5,
			height : 1.9		
		},
		{
			shape : 'rect',
			y : 34.4,
			width : 26.5,
			height : 1.9		
		}],
		bd3 : [{
			shape : 'path',
			d : 'M0.2,37.4h12.7v-8.8h1.9v10.6H0.2V37.4z'
		},
		{
			shape : 'path',
			d : 'M0.2,34.4h8.7v-5.8h1.9v7.6H0.2V34.4z'
		}],
		bs1 : [{
			shape : 'path',
			d : 'M26.4,39.2H10.6V27.8h2.8v8.7h13V39.2L26.4,39.2z'
		}],
		bs2 : [{
			shape : 'rect',
			y : 36.5,
			width : 26.5,
			height : 2.7		
		}],
		bs3 : [{
			shape : 'path',
			d : 'M0,39.2v-2.7h13v-8.7h2.8v11.4H0.1H0z'
		}]
	}
}