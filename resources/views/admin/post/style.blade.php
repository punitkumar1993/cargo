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

    .upload-photo.ready .buttons #reset {
        display: inline;
    }

    .upload-photo #display,
    .upload-photo .buttons #reset,
    .upload-photo.ready .upload-msg {
        display: none;
    }

    .hide {
        display: none;
    }
</style>