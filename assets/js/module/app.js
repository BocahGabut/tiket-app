export const DirectLink = (link,open) => {
	event.preventDefault()
	if(open === true){
		window.open(`${link}`,'_blank')
	}else {
		location.href = `${link}`
	}
}

export const PreviewImage = (source, target,remove) => {
	var oFReader = new FileReader();
	oFReader.readAsDataURL(document.getElementById(`${source}`).files[0]);

	oFReader.onload = function(oFREvent) {
		document.getElementById(`${target}`).src = oFREvent.target.result;
		document.getElementById(`${remove}`).style.display = 'block'
	};
} 

export const DeleteImage = (source,target,remove) => {
	document.getElementById(`${source}`).value = ''
	document.getElementById(`${target}`).src = NoImage()
	document.getElementById(`${remove}`).style.display = 'none'
}

export const DeleteSelected = (url,id) => {
	$.ajax({
		url: `${url}`,
		type: 'POST',
		data: {
			id: `${id}`
		},
		dataType: 'json',
	})
}

export const PreviewModal = (url,id,type,modal,container) => {
	$.ajax({
		url: `${url}`,
		type: `${type}`,
		data: {
			id: `${id}`
		},
		dataType: 'json',
		success: (data) => {
			for(var i = 0; i < data.length;i++){
				$(`#${modal}`).modal('show')
				document.getElementById(`${container}`).innerHTML = data[i].content
			}
		}
	})
}

export const DeleteMessage = (id, url, target) => {
	event.preventDefault();
	Swal.fire({
		title: "Anda Yakin ?",
		text: "Akan Menghapus Data Ini !",
		type: "warning",
		showCancelButton: !0,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Yes, delete it!",
		confirmButtonClass: "btn btn-primary",
		cancelButtonClass: "btn btn-danger ml-1",
		buttonsStyling: !1
	}).then((t) => {
		t.value ? Swal.fire({
				type: "success",
				title: "Deleted!",
				text: "Data Berhasil Di Hapus",
				confirmButtonClass: "btn btn-success"
			}).then((succ) => {
				$.ajax({
					url: `${url}`,
					type: "post",
					data: {
						id: `${id}`
					},
				})
				setTimeout(() => {
					window.location.href = `${target}`						
				}, 250);
			}) :
			t.dismiss === Swal.DismissReason.cancel && Swal.fire({
				title: "Cancelled",
				text: "Data Tidak Dihapus :)",
				type: "error",
				confirmButtonClass: "btn btn-success"
			})
	})
}

export const ExportCSV = (file) => {
	var titles = [];
	var data = [];
  
	/*
	 * Get the table headers, this will be CSV headers
	 * The count of headers will be CSV string separator
	 */
	$('.data-export th').each(function() {
	  titles.push($(this).text());
	});
  
	/*
	 * Get the actual data, this will contain all the data, in 1 array
	 */
	$('.data-export td').each(function() {
	  data.push($(this).text());
	});
	
	/*
	 * Convert our data to CSV string
	 */
	var CSVString = prepCSVRow(titles, titles.length, '');
	CSVString = prepCSVRow(data, titles.length, CSVString);
  
	/*
	 * Make CSV downloadable
	 */
	var downloadLink = document.createElement("a");
	var blob = new Blob(["\ufeff", CSVString]);
	var url = URL.createObjectURL(blob);
	downloadLink.href = url;
	downloadLink.download = `${file}.csv`;
  
	/*
	 * Actually download CSV
	 */
	document.body.appendChild(downloadLink);
	downloadLink.click();
	document.body.removeChild(downloadLink);
}
	 /*
  * Convert data array to CSV string
  * @param arr {Array} - the actual data
  * @param columnCount {Number} - the amount to split the data into columns
  * @param initial {String} - initial string to append to CSV string
  * return {String} - ready CSV string
  */
  const prepCSVRow = (arr, columnCount, initial) => {
	var row = ''; // this will hold data
	var delimeter = ','; // data slice separator, in excel it's `;`, in usual CSv it's `,`
	var newLine = '\r\n'; // newline separator for CSV row
  
	/*
	 * Convert [1,2,3,4] into [[1,2], [3,4]] while count is 2
	 * @param _arr {Array} - the actual array to split
	 * @param _count {Number} - the amount to split
	 * return {Array} - splitted array
	 */
	function splitArray(_arr, _count) {
	  var splitted = [];
	  var result = [];
	  _arr.forEach(function(item, idx) {
		if ((idx + 1) % _count === 0) {
		  splitted.push(item);
		  result.push(splitted);
		  splitted = [];
		} else {
		  splitted.push(item);
		}
	  });
	  return result;
	}
	var plainArr = splitArray(arr, columnCount);
	// don't know how to explain this
	// you just have to like follow the code
	// and you understand, it's pretty simple
	// it converts `['a', 'b', 'c']` to `a,b,c` string
	plainArr.forEach(function(arrItem) {
	  arrItem.forEach(function(item, idx) {
		row += item + ((idx + 1) === arrItem.length ? '' : delimeter);
	  });
	  row += newLine;
	});
	return initial + row;
}

export const NoImage = () => {
	var image = `data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAABmJLR0QA/wD/AP+gvaeTAAADo0lEQVR4nO3cvW7UQBSG4TcQEokCJIpIKEBLzQVwAxQQISIo6GlIWm6BS4CeIqKhyw0gkdAQJAroECCQEBSgQMNfKLwrwmZ2x45n5hzb3yedJusdj+fR2N6Jd0FRFEVR0mUV+Ay8B1aM+zL4zAGfgL1R/QSum/ZI4SP/QITiIFepEITiKNc4iPILuGnZqaFHKA4jFIcRisMIxWGEYpQ94CVwOvBaCEXVrqIZbygUZyBCcQgiFIcgs6ILffNkBQGhNE12EBBKkxQBAaHUTTEQEEqdFAUBocRSHASEMismICCUaTEDAaGEYgoCQpmMOQgIZX9cgIBQxnEDAtWjRF4fMVoE1oFt4NuotoG10Wup4goEfKIsA885eOzj2hltkyLuQMAXyiKzMfajpJgpLkHAD8o6cYxx3U6wP7cg4APlKfVBthLszzUI2N997VIfZDfB/tyDgC1KE5CvCfbXCRCwO33plDUjFihr1Afp9UV9DjgR+HtplEWqW9oYxg6wkGB/LkGOAPeAF8BS4PXSKMvMRun1B8NjwMa+9r2gLFCdkraoLvS7wJPR31LMjHFcgRwHNgP7aPIwXtcXJN2AnAQeB9ofGooLkCXgWaDtIaKYg5wDXgXaHSqKKch54E2gzSGjmIFc4OCPEAjFCOQi8CXQllAMQC4B3wPtCKVKUZAbwI9AG22rxIfHFeDdqHL+ClIxkFvA78D7uzBTVifayDnTioDcAf4E3tsFlEmM3ChZQeaAu4H3dAVlGkZOlGwgR4D7ge27ghLDyIWSBWSB/1dsu4ZSFyMHSnKQaSu2XUFpipEaJSlIbMXWopreErf5bn2K/8ckA6m7Yut9prSttjMlCUjTFVurmXIqcDyhmdK22syU1iCHXbEtXQ+B+SnH5GmmtAZps2JbqjaYjjGOl5nSGsR7hTDm8Xv66jVI6DR1FHiA3wt9b0EeEZ4Zh33EqG3VnSm9BTkz0e9JDK8ogwCZhuERpbcgm1QoZ6lOX7HtvaD0FuQw5eFCL5CJskYRSKAsUQQypaxQBDKjLFAEEqnSd18CqVGWPxYdjfXgDA0lGuuBGRpKNNaDYl2lUaKxHhAPVRIlGuvB8FKlUKKxHghPVQIlGutB8Fa5UaKxHgCPlRMlGuuD91q5UKKxPnDPlQMlGuuD9l6pUZSM6eoXUXsdoTiMUBxGKA4jFIcRisNM+3rdFctODT0hlLemPVIOoHyw7Y4C1WnqNdXsuGzcF0VRFKVH+Qucf78VsDAm2gAAAABJRU5ErkJggg==`

	return image
}
