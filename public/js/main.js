$(document).ready(async function() {
    const server = new Server();
    const canvas = new Canvas();

    const result = await server.getStruct();

    const SIZE = 40;
    if (result.result) {
        canvas.clear();
        const map = result.data.map;
        for (let i = 0; i < map.length; i++) {
            for (let j = 0; j < map[i].length; j++) {
                const color = (map[i][j].type === 'mount') ? 'blue' : 'green';
                canvas.printRect(i * SIZE, j * SIZE, SIZE, SIZE, color);
            }
        }
    }
});