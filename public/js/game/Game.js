function Game(options) {

    const server = options.server;
    const callbacks = options.callbacks || {};

    const canvas = new Canvas();

    function render(data) {
        const SIZE = 40;
        canvas.clear();
        const map = data.map;
        for (let i = 0; i < map.length; i++) {
            for (let j = 0; j < map[i].length; j++) {
                const color = (map[i][j].type === 'mount') ? 'blue' : 'green';
                canvas.printRect(i * SIZE, j * SIZE, SIZE, SIZE, color);
            }
        }
    }

    async function refresh() {
        const result = await server.getStruct();
        if (result.result) {
            render(result.data);
        }
    }

    function init() {

        $('.game-menu').show();
        $('#game-field').hide();

        $('#gameStart').on('click', () => {
            // Проверить, что игрок ВЫБРАЛ за кого собрался играть!!!
            //...
            $('.game-menu').hide();
            $('#game-field').show();

            refresh();
        });

        document.getElementById('gameStart').onclick = async function () {
        };
    }
    init();
}