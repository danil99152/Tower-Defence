function Canvas() {
    let canvas;
    let context;

    this.clear = function() {
        context.fillStyle = 'black';
        context.fillRect(0, 0, canvas.width, canvas.height);
    };

    this.printRect = function(x, y, width, height, color) {
        context.fillStyle = color;
        context.fillRect(x, y, width, height);
    };

    function init() {
        canvas = document.getElementById('game-field');
        canvas.width  = 400;
        canvas.height = 400;
        context = canvas.getContext('2d');
    }
    init();
}