function Canvas() {
    let canvas;
    let context;

    this.clear = function() {
        context.fillStyle = 'white';
        context.fillRect(0, 0, canvas.width, canvas.height);
    };

    this.line = function (x1, y1, x2, y2, color) {
        context.beginPath();
        context.strokeStyle = color || "black";
        context.moveTo(x1, y1);
        context.lineTo(x2, y2);
        context.stroke();
    };

    this.circle = function (x, y, r, color) {
        context.beginPath();
        context.strokeStyle = color || "yellow";
        context.arc(x, y, r, 0, 2 * Math.PI);
        context.stroke();
    };

    this.text = function (text, x, y, color, size) {
        context.fillStyle = color || "green";
        context.font = (size || 50) + "px Georgia";
        context.fillText(text, x, y);
    };

    this.sprite = function (img, sx, sy, swidth, sheight, x, y, width, height) {
        context.drawImage(img, sx, sy, swidth, sheight, x, y, width, height);
    };

    this.save = function(){
        context.save();
    };

    function init() {
        canvas = document.getElementById('game-field');
        canvas.width  = window.innerHeight-100;
        canvas.height = window.innerHeight-100;
        context = canvas.getContext('2d');
    }
    init();
}