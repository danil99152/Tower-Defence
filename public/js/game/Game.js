function Game(options) {

    const server = options.server;
    const callbacks = options.callbacks || {};

    const canvas = new Canvas();

    // картинка с травой
    const imgGrass = new Image();
    imgGrass.src = "public/img/sprites/grass_32x32.png";

    // спрайты башен на карте
    const imgTower = new Image();
    imgTower.src = "public/img/sprites/towers_160x160.png";

    // спрайты мобов на карте
    const imgMob = new Image();
    imgMob.src = "public/img/sprites/mob_50x90.png";

    // спрайты дорог на карте
    const imgRoad = new Image();
    imgRoad.src = "public/img/sprites/roads_32x32.png"

    const SIZE = 32;
    const SPRITES = {
        grass: {
            img: imgGrass,
            sprite: [
                { x: 0, y: 0 },
                { x: SIZE, y: 0 }
            ]
        },
        road: {
            img: imgRoad,
            sprite: [
                { x: 0, y: 0 },
                { x: SIZE, y: 0 },
                { x: SIZE, y: SIZE }
            ]
        },
        tower: {
            img: imgTower,
            sprite: [
                { x: 0, y: 0 },
                { x: 160, y: 0},
                { x: 320, y: 0},
                { x: 480, y: 0}
            ]
        },
        mob: {
            img: imgMob,
            sprite: [
                { x: 0, y: 0 },
                { x: 160, y: 0},
                { x: 320, y: 0},
                { x: 480, y: 0}
            ]
        }
    };

    function printSprite(tile, x, y) {
        if (tile && tile.type && tile.sprite) {
            const sprite = SPRITES[tile.type];
            canvas.sprite(sprite.img,
                sprite.sprite[tile.sprite - 0].x, sprite.sprite[tile.sprite - 0].y, SIZE, SIZE,
                x * SIZE, y * SIZE, SIZE, SIZE);
        }
    }

    function printTowerSprite(tower) {
        if(tower && tower.type) {
            const sprite = SPRITES.tower;
            canvas.sprite(sprite.img,
                sprite.sprite[tower.type - 0].x, sprite.sprite[tower.type - 0].y, 160, 160,
                tower.x * SIZE - 64, tower.y * SIZE - 128, 160, 160);
        }
    }

    function printMobSprite(mob) {
        if (mob && mob.type) {
            const sprite = SPRITES.mob;
            canvas.sprite(sprite.img,
                sprite.sprite[mob.type - 0].x, sprite.sprite[mob.type - 0].y, 45, 60,
                mob.x * SIZE, mob.y * SIZE - (60 - SIZE), 45, 60);
        }
    }

    function printRoadSprite(road) {
        if(road && road.type) {
            const sprite = SPRITES.road;
            canvas.sprite(sprite.img,
                sprite.sprite[road.type - 0].x, sprite.sprite[road.type - 0].y, 32, 32,
                road.x * SIZE, road.y * SIZE, 32, 32);
        }
    }

    function render(data) {
        canvas.clear();
        const map = data.map;
        for (let i = 0; i < map.length; i++) {
            for (let j = 0; j < map[i].length; j++) {
                printSprite(map[i][j], i, j);
            }
        }
        //нарисовать мобов на карте
        data.mobs.forEach(mob => printMobSprite(mob));
        // нарисовать дороги(через passability)
        //data.roads.forEach(road => printRoadSprite(road));
        // нарисовать башни на карте
        data.towers.forEach(tower => printTowerSprite(tower));
    }

    async function refresh() {
        // послать запрос на сервер и отрисовать полученные данные
        const result = await server.getStruct();
        if (result.result) {
            render(result.data);
        }
    }

    this.init = () => {
        refresh();
        this.deinit();
        interval = setInterval(refresh, 1000);
    };

    this.deinit = () => {
        if (interval) {
            clearInterval(interval);
        }
    };

    function init() {

        $('.game-menu').show();
        $('#game').hide();

        var method;

        $('.selectTeam').on('click', function() {
            method = this.value;
        });

        // Проверить, что игрок ВЫБРАЛ за кого собрался играть!!!
        $('#gameStart').on('click', async () => {
            if (method) {
                await server.startGame(method);
                const result = await server.getStruct();
                if (result.result) {
                    render(result.data);
                }
                $('.game-menu').hide();
                $('#game').show();
                refresh();
            } else {
                alert('Выбери сторону!');
            }
        });
    }
    init();
}