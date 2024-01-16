$(document).on('click', '.js-download-action', event => {
    event.preventDefault();
    $('#modal_download_url').modal('show');
});

$(document).on('click', '.js-create-folder-action', event => {
    event.preventDefault();
    $('#modal_add_folder').modal('show');
});