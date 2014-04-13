//-------------------------------------------------------------------------------------
//
// THIS FILE IS NOT A PART OF THE PLUGIN, IT'S ONLY FOR THE DEMO
//
//-------------------------------------------------------------------------------------
!(function(){
    'use strict';

	var numOfImages = window.location.search ? parseInt(window.location.search.match(/\d+$/)[0]) : 70,
		gallery = $('#gallery'),
		videos = [
			{
				title: "THOR 2",
				url: "http://www.youtube.com/embed/3bFZJ-3zNFg",
				thumb: "http://img.youtube.com/vi/3bFZJ-3zNFg/0.jpg"
			},
			{
				title: "IRON MAN 2",
				url: "http://www.youtube.com/embed/FNQowwwwYa0",
				thumb: "http://img.youtube.com/vi/FNQowwwwYa0/0.jpg"
			},
			{
				title: "HOMBRE DE ACERO",
				url: "http://www.youtube.com/embed/T6DJcgm3wNY",
				thumb: "http://img.youtube.com/vi/T6DJcgm3wNY/0.jpg"
			},
			{
				title: "EL CONJURO",
				url: "http://www.youtube.com/embed/OJgDCNyfWfQ",
				thumb: "http://img.youtube.com/vi/OJgDCNyfWfQ/0.jpg"
			},
			{
				title: "EL LLANERO SOLITARIO",
				url: "http://www.youtube.com/embed/0kk9wMTxPGE",
				thumb: "http://img.youtube.com/vi/0kk9wMTxPGE/0.jpg"
			},
			{
				title: "300: LA REBELION DE UN IMPERIO",
				url: "http://www.youtube.com/embed/leXo4-QLNVc",
				thumb: "http://img.youtube.com/vi/leXo4-QLNVc/0.jpg"
			},
			{
				title: "EL HOBBIT LA DESOLACION DE SMAUG",
				url: "http://www.youtube.com/embed/fmlO47FPhQc",
				thumb: "http://img.youtube.com/vi/fmlO47FPhQc/0.jpg"
			},
			{
				title: "THE WOLVERINE",
				url: "http://www.youtube.com/embed/Rh1LdTFkm7I",
				thumb: "http://img.youtube.com/vi/Rh1LdTFkm7I/0.jpg"
			},
			{
				title: "SCARY MOVIE 5",
				url: "http://www.youtube.com/embed/yPvcAUpjqPY",
				thumb: "http://img.youtube.com/vi/yPvcAUpjqPY/0.jpg"
			},
			{
				title: "INSIDIOUS 2",
				url: "http://www.youtube.com/embed/bBnKimrEZXY",
				thumb: "http://img.youtube.com/vi/bBnKimrEZXY/0.jpg"
			},
			{
				title: "ROBOCOP",
				url: "http://www.youtube.com/embed/INmtQXUXez8",
				thumb: "http://img.youtube.com/vi/INmtQXUXez8/0.jpg"
			},
			{
				title: "THE HUNGER GAMES: CATCHING FIRE",
				url: "http://www.youtube.com/embed/keT5CRhhy84",
				thumb: "http://img.youtube.com/vi/keT5CRhhy84/0.jpg"
			},
			{
				title: "ENDER'S GAME",
				url: "http://www.youtube.com/embed/nC6OYmj6YT8",
				thumb: "http://img.youtube.com/vi/nC6OYmj6YT8/0.jpg"
			},
			{
				title: "KICK-ASS 2",
				url: "http://www.youtube.com/embed/B3SlhpnfAZk",
				thumb: "http://img.youtube.com/vi/B3SlhpnfAZk/0.jpg"
			},
			{
				title: "MI VILLANO FAVORITO 2",
				url: "http://www.youtube.com/embed/xtO1I0YWVXw",
				thumb: "http://img.youtube.com/vi/xtO1I0YWVXw/0.jpg"
			},
			{
				title: "47 RONIN",
				url: "http://www.youtube.com/embed/j8cKdDkkIYY",
				thumb: "http://img.youtube.com/vi/j8cKdDkkIYY/0.jpg"
			},
			{
				title: "MAN OF TAI CHI",
				url: "http://www.youtube.com/embed/HIKQCZDYfEI",
				thumb: "http://img.youtube.com/vi/HIKQCZDYfEI/0.jpg"
			},
			{
				title: "TRON 2 - OVER THE EDGE",
				url: "http://www.youtube.com/embed/0V7HaQ7EaB0",
				thumb: "http://img.youtube.com/vi/0V7HaQ7EaB0/0.jpg"
			},
			//PELICULAS 2014
			{
				title:"CAPITÁN AMERICA Y EL SOLDADO DEL INVIERNO",
				url: "www.youtube.com/embed/mGqYQog6biY",
				thumb: "http://img.youtube.com/vi/mGqYQog6biY/0.jpg"
			},
			{
				title:"EL SORPRENDENTE HOMBRE ARAÑA LA AMENAZA DE ELECTRO",
				url:"http://www.youtube.com/watch?v=ayi5y0Y4s2A",
				thumb:"http://img.youtube.com/vi/ayi5y0Y4s2A/0.jpg"
			},
			{
				title:"GODZILLA",
				url:"http://www.youtube.com/watch?v=vIu85WQTPRc",
				thumb:"http://img.youtube.com/vi/vIu85WQTPRc/0.jpg"
			},
			{
				title:"RÁPIDOS Y FURIOSOS 7",
				url:"http://www.youtube.com/watch?v=lDV2sg7RGoY",
				thumb:"http://img.youtube.com/vi/lDV2sg7RGoY/0.jpg"
			},
			{
				title:"YO, FRANKENSTEIN",
				url:"http://www.youtube.com/watch?v=ptWegkT6DHg",
				thumb:"http://img.youtube.com/vi/ptWegkT6DHg/0.jpg"
			},
			{
				title:"X-MEN, DIAS DEL FUTURO PASADO",
				url:"http://www.youtube.com/watch?v=-fzkF-oOKS8",
				thumb:"http://img.youtube.com/vi/-fzkF-oOKS8/0.jpg"
			},
			{
				title:"TRANSFORMERS: AGE OF EXTINCTION",
				url:"http://www.youtube.com/watch?v=dYDGqmxMZFI",
				thumb:"http://img.youtube.com/vi/dYDGqmxMZFI/0.jpg"
			},
			{
				title:"EL AMANECER DEL PLANETA DE LOS SIMIOS",
				url:"http://www.youtube.com/watch?v=AfTR6luSAjE",
				thumb:"http://img.youtube.com/vi/AfTR6luSAjE/0.jpg"
			},
			{
				title:"LOS JUEGOS DEL HAMBRE: SINSAJO - PARTE 1",
				url:"http://www.youtube.com/watch?v=rZta2tAb908",
				thumb:"http://img.youtube.com/vi/rZta2tAb908/0.jpg"
			},
			{
				title:"El HOBBIT: HISTORIA DE UNA IDA Y UNA VUELTA",
				url:"http://www.youtube.com/watch?v=FtxSsJ1EtA4",
				thumb:"http://img.youtube.com/vi/FtxSsJ1EtA4/0.jpg"
			}			
		];
		
    // Get some photos from Flickr for the demo
    $.ajax({
        url: 'http://api.flickr.com/services/rest/',
        data: {
            format: 'json',
            method: 'flickr.interestingness.getList',
			per_page : numOfImages,
            api_key: 'b51d3a7c3988ba6052e25cb152aecba2' // this is my own API key, please use yours
        },
	    dataType: 'jsonp',
        jsonp: 'jsoncallback'
    })
	.done(function (data){
        var loadedIndex = 1, isVideo;
		
		// add the videos to the collection
		data.photos.photo = data.photos.photo.concat(videos);
		
        $.each( data.photos.photo, function(index, photo){
			isVideo = photo.thumb ? true : false;
			// http://www.flickr.com/services/api/misc.urls.html
            var url = 'http://farmaqui' + photo.farm + '.static.flickr.com/' + photo.server + '/' + photo.id + '_' + photo.secret,
				img = document.createElement('img');
			
			// lazy show the photos one by one
			img.onload = function(e){
				img.onload = null;
				var link = document.createElement('a'),
				li = document.createElement('li')
				link.href = this.largeUrl;

				link.appendChild(this);
				if( this.isVideo ){
					link.rel = 'video';
					li.className = 'video'
				}
				li.appendChild(link);
				gallery[0].appendChild(li);
			
				setTimeout( function(){ 
					$(li).addClass('loaded');
				}, 100*loadedIndex++);
			};
			
			img['largeUrl'] = isVideo ? photo.url : url + '_b.jpg';
			img['isVideo'] = isVideo;
			img.src = isVideo ? photo.thumb : url + '_t.jpg';
			img.title = photo.title;
        });

		// finally, initialize photobox on all retrieved images
		$('#gallery').photobox('a', { thumbs:true }, callback);
		// using setTimeout to make sure all images were in the DOM, before the history.load() function is looking them up to match the url hash
		setTimeout(window._photobox.history.load, 1000);
		function callback(){
			console.log('callback for loaded content:', this);
		};
    });
})();