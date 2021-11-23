import { DirectLink,PreviewImage,DeleteImage,NoImage,PreviewModal,ExportCSV,DeleteMessage,DeleteSelected } from "./module/app.js";

var body = document.getElementsByTagName('body')[0]

if(document.querySelectorAll('.image-thumb').length > 0) {
	if(document.querySelectorAll('.image-thumb')[0].getAttribute('data-prev') !== 'true') {
		document.querySelectorAll('.image-thumb')[0].src = NoImage()
	}
}


var tr = document.querySelectorAll('tr.tr-click'),
	BtnAdd = document.querySelectorAll('button.btn-add'),
	PrevImage = document.querySelectorAll('input.thumbnail'),
	RevImage = document.querySelectorAll('button.remove-thumbnail'),
	SelectCountry = document.querySelectorAll('select.select-country'),
	CheckSelect = document.querySelectorAll('input.checkbox-selected'),
	ButtonPreview = document.querySelectorAll('button.button-preview'),
	ButtonCSV = document.querySelectorAll('button.button-csv'),
	ButtonDelete = document.querySelectorAll('button.button-delete'),
	ButtonDelSelected = document.querySelectorAll('button.button-del-selected'),
	ButtonDirect = document.querySelectorAll('button.button-direct'),
 	ButtonPrint = document.querySelectorAll('button.button-print'),
 	ButtonAddTransit = document.querySelectorAll('button.button-add-transit'),
 	DateFrom = document.querySelectorAll('input.from-date')

if(DateFrom.length > 0 ){
	DateFrom[0].addEventListener('change', _ => {
		// DateTo[0].setAttribute('min',DateFrom[0].value)
		// alert(DateFrom[0].value)

		// var date = DateFrom[0].value
		// var res = date.replace("-"," ")
		// var result = res.replace("-"," ")
		// console.log(result)
		var day = new Date(DateFrom[0].value)
		var nextDay = new Date(day)
		nextDay.setDate(day.getDate() + 1)

		document.getElementById(DateFrom[0].getAttribute('data-id')).setAttribute('min',convert(nextDay))
		document.getElementById(DateFrom[0].getAttribute('data-id')).focus()
	})
}

function convert(str) {
	var date = new Date(str),
	  mnth = ("0" + (date.getMonth() + 1)).slice(-2),
	  day = ("0" + date.getDate()).slice(-2);
	return [date.getFullYear(), mnth, day].join("-");
  }

if(ButtonDirect.length > 0){
	for(let i = 0;i < ButtonDirect.length;i++){
		ButtonDirect[i].addEventListener('click', _ => {
			DirectLink(ButtonDirect[i].getAttribute('data-url'),ButtonDirect[i].getAttribute('data-valid'))
		})
	}
}

if(ButtonPrint.length > 0){
	for(let i = 0;i < ButtonPrint.length;i++){
		ButtonPrint[i].addEventListener('click', _ => {
			printJS({
				showModal: true,
				printable: ButtonPrint[i].getAttribute('data-url'),
				// onPrintDialogClose: function () {
				// 	window.location.href = "http://google.com"
				// }
			});
		})
	}
}

$(document).ready(function() {
	// var dataFix = JSON.stringify(dataSet)
	$('#data-table').DataTable({
		responsive: true,
		filter: true,
		info: true,
		ordering: true,
		processing: true,
		retrieve: false    
	});
});

if(ButtonCSV.length > 0 ){
	ButtonCSV[0].addEventListener('click', () => {
		ExportCSV(ButtonCSV[0].getAttribute('data-name'))
	})
}

if(ButtonDelete.length > 0 ){
	for(let i = 0; i < ButtonDelete.length; i++){
		ButtonDelete[i].addEventListener('click', () => {
			DeleteMessage(ButtonDelete[i].getAttribute('data-id'),ButtonDelete[i].getAttribute('data-url'),ButtonDelete[i].getAttribute('data-target'))
		})
	}
}

if(ButtonPreview.length > 0 ){
	for(let i = 0; i < ButtonPreview.length; i++){
		ButtonPreview[i].addEventListener('click', () => {
			PreviewModal(ButtonPreview[i].getAttribute('data-url'),ButtonPreview[i].getAttribute('data-id'),ButtonPreview[i].getAttribute('data-type'),ButtonPreview[i].getAttribute('data-modal'),'modal-container')
		})
	}
}

if(ButtonDelSelected.length > 0 ){
	for(let i = 0; i < ButtonDelSelected.length; i++){
		ButtonDelSelected[i].addEventListener('click', () => {
			let length = $('[name="'+ButtonDelSelected[i].getAttribute('data-name')+'[]"]:checked').length
			if(length < 1){
				swal({
					text: 'Please at least select one item.',
					showCloseButton: true,
				})
			} else {
				const waitFunc = async _ => {
					for(let v = 0; v < length;v++){
						DeleteSelected(ButtonDelSelected[i].getAttribute('data-url'),$('[name="'+ButtonDelSelected[i].getAttribute('data-name')+'[]"]:checked')[v].value)
					}
				}
				
				const LoadPage = async _ => {
					await waitFunc()
					setTimeout(() => {
						window.location.href = body.getAttribute('data-name')
					}, 1200);
				}

				LoadPage()

			}
		})
	}
}

if(CheckSelect.length > 0 ){
	CheckSelect[0].addEventListener('change', (e) => {
		var checkboxes = document.getElementsByTagName('input');
		e.preventDefault()
		if(CheckSelect[0].checked){
			for (var i = 0; i < checkboxes.length; i++) {
				if (checkboxes[i].type == 'checkbox' ) {
					checkboxes[i].checked = true;
				}
			}
		}else {
			for (var i = 0; i < checkboxes.length; i++) {
				if (checkboxes[i].type == 'checkbox') {
					checkboxes[i].checked = false;
				}
			}
		}
		
	})
}

if(SelectCountry.length > 0){
	for(let i =0;i < SelectCountry.length;i++){
		var settings = {
			"async": true,
			"crossDomain": true,
			"url": "https://restcountries.com/v3.1/all",
			"method": "GET",
			"headers": {
			  "cache-control": "no-cache",
			}
		  }
		  
		  $.ajax(settings).done(function (response) {
			response.map((items) => {
				SelectCountry[i].innerHTML += `
				<option value="${items.name.common}">${items.name.common}</option>
				`
			})
		  });
	}
}

// console.log(tr)
if(tr.length > 0 ){
	for(let i = 0; i < tr.length;i++){
		tr[i].addEventListener('click',(e)=>{
			e.preventDefault()
			DirectLink('details?action='+ body.getAttribute('data-name') +'&data=' + tr[i].getAttribute('data-airlines'))
		})
	}
}

if(BtnAdd.length > 0 ){
	for(let i = 0; i < BtnAdd.length;i++){
		BtnAdd[i].addEventListener('click',(e)=> {
			e.preventDefault()
			DirectLink('?action=' + body.getAttribute('data-name'))
		})
	}
}

if(PrevImage.length > 0) {
	PrevImage[0].addEventListener('change',(e)=>{
		e.preventDefault()
		PreviewImage(PrevImage[0].id,PrevImage[0].getAttribute('data-thumb'),PrevImage[0].getAttribute('data-remove'))
	})
}

if(RevImage.length > 0) {
	RevImage[0].addEventListener('click',(e)=>{
		e.preventDefault()
		DeleteImage(RevImage[0].getAttribute('data-file'),RevImage[0].getAttribute('data-thumb'),RevImage[0].id)
	})
}

var GetCountryAir = document.querySelectorAll('select.select-country-air')

if(GetCountryAir.length > 0){
	var settings = {
		"url": "https://countriesnow.space/api/v0.1/countries/iso",
		"method": "GET",
	  };
	  
	  $.ajax(settings).done(function (response) {
		response.data.map((items) => {
			GetCountryAir[0].innerHTML += `<option value"`+items.name+`">`+items.name+`</option>`
		})
	  });

	$('#country').on('change', _ => {
		var getCode = {
			"url": "https://countriesnow.space/api/v0.1/countries/iso",
			"method": "POST",
			"headers": {
			  "Content-Type": "application/json"
			},
			"data": JSON.stringify({
			  "country": GetCountryAir[0].value
			}),
		  };
		  
		  $.ajax(getCode).done(function (response) {
			document.getElementById('country-code').value = response.data.Iso3
		  });

		  var getCity = {
			"url": "https://countriesnow.space/api/v0.1/countries/cities",
			"method": "POST",
			"headers": {
			  "Content-Type": "application/json"
			},
			"data": JSON.stringify({
			  "country": GetCountryAir[0].value
			}),
		  };
		  
		  document.getElementById('city-').innerHTML = ''
		  document.getElementById('loading').style.display = 'flex'
		 $.ajax(getCity).done(function (city) {
			 city.data.map((params) => {
				  document.getElementById('city-').innerHTML += `
				  <option value="`+params+`">`+params+`</option>
				  `	
				})
				document.getElementById('loading').style.display = 'none'
		  });
	})

	$('#city-').on('change', _ => {
		var text = document.getElementById('city-').value.replace(/\s/g, ''),
				ConvertArray = text.match(/.{1,3}/g),
				getCharacter = ConvertArray.map((items) => items[0]).join(''),
				iso3
		
				if(getCharacter.length > 3){
					iso3 = getCharacter.substring(0, 3 ).toUpperCase()
				} else {
					iso3 = getCharacter.toUpperCase()
				}
		document.getElementById('city-code').value = iso3		
	})

}


if(ButtonAddTransit.length > 0){
	ButtonAddTransit[0].addEventListener('click', _ => {
		var temp = document.getElementsByTagName("template")[0],
			ParentTr = document.getElementById('template-first'),
			clon = temp.content.cloneNode(true)
			
			if (ParentTr.nextSibling) {
				ParentTr.parentNode.insertBefore(clon, ParentTr.nextSibling);
			}
			else {
				ParentTr.parentNode.appendChild(clon);
			}
			
		// var getSelectCountry = document.querySelectorAll('select.country-transit'),
			var getSelectPlane = document.querySelectorAll('button.button-remove-transit'),
			 	getTemplate = document.querySelectorAll('tr.template-items')

		for(let ctr = 0; ctr < getSelectPlane.length;){
			getSelectPlane[ctr].setAttribute('data-id','tr-' + ctr )
			getSelectPlane[ctr].setAttribute('id','btn-' + ctr )
			getTemplate[ctr].setAttribute('id','tr-' + ctr)
			// getSelectCountry[ctr].setAttribute('id',"country-transit-" + ctr)
			// getSelectPlane[ctr].setAttribute('id',"plane-transit-" + getSelectPlane.length)
			ctr++
		}
		
		$('select.country-transit').select2();
		$('select.plane-transit').select2();
		RemoveChild()
	})
}

const RemoveChild = _ => {
	var temp = document.querySelectorAll('tr.template-items')
	for(let i = 0; i < temp.length;i++){
		document.getElementById('btn-' + i).addEventListener('click', _ => {
			temp[i].remove()
		})
	}

}
