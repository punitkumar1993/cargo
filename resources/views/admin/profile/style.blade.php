<style>
    .upload-msg {
        text-align: center;
        padding-top: 125px;
        padding-left: 30px;
        padding-right: 30px;
        font-size: 22px;
        color: #aaa;
        width: 300px;
        height: 300px;
        margin: 10px auto;
        border: 1px solid #aaa;
    }

    .upload-photo.ready #display {
        display: block;
    }

    .upload-photo.result #display-i {
        background: #e1e1e1;
        width: 300px;
        padding: 50px;
        height: 300px;
        margin-bottom: 30px
    }

    .upload-photo.ready .buttons #btn-upload-result,
    .upload-photo.ready .buttons #btn-upload-reset {
        display: inline;
    }

    .upload-photo #display,
    .upload-photo .buttons #btn-upload-result,
    .upload-photo .buttons #btn-upload-reset,
    .upload-photo.ready .upload-msg {
        display: none;
    }
</style>