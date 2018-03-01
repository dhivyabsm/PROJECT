var _submit = document.getElementById('_submit'),
        _file = document.getElementById('_file'),
        _progress = document.getElementById('_progress');

var upload = function () {

    if (_file.files.length === 0) {
        return;
    }

    var data = new FormData();
//    for (var i = 0; i <= _file.files.length; i++) {
//        data.append(i, _file.files[i]);
//    }
//
//    var formData = new FormData();
    for (var i = 0; i < _file.files.length; i++) {
        var fileup = _file.files[i];
        if (!fileup.type.match('image.*')) {
            continue;
        }
        data.append('fil' + fileup.lastModifiedDate, fileup);
    }


    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            try {
                var resp = JSON.parse(request.response);
            } catch (e) {
                var resp = {
                    status: 'error',
                    data: 'Unknown error occurred: [' + request.responseText + ']'
                };
            }
            console.log(resp.status + ': ' + resp.data);
        }
    };

    request.upload.addEventListener('progress', function (e) {
        _progress.style.width = Math.ceil(e.loaded / e.total) * 100 + '%';
    }, false);
    
    request.open('POST', '/fileswap/upload.php');
    request.send(data);
}

_submit.addEventListener('click', upload);