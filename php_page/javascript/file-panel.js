function openFiles() {
    document.getElementById("file-panel-id-main").style.width = "300px";
    document.getElementById("file-panel-id-all").style.display = "inline";
    document.getElementById("close").style.display = "inline";
    document.getElementById("open").style.display = "none";
}

/* Установите ширину боковой панели в 0 (скройте ее) */
function closeFiles() {
    document.getElementById("file-panel-id-main").style.width = "0px";
    document.getElementById("file-panel-id-all").style.display = "none";
    document.getElementById("open").style.display = "inline";
    document.getElementById("close").style.display = "none";
}
