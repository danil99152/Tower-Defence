function Game(options) {

    const server = options.server;
    const callbacks = options.callbacks || {};

    const canvas = new Canvas();

    let interval = null;

    // картинка с травой
    const imgGrass = new Image();
    imgGrass.src = "public/img/sprites/grass.png";

    // спрайты башен на карте
    const imgTower = new Image();
    imgTower.src = "public/img/sprites/towers_160x160.png";

    // спрайты мобов на карте
    const imgMob = new Image();
    imgMob.src = "public/img/sprites/mob_50x90.png";

    // спрайты дорог на карте
    const imgRoad = new Image();
    imgRoad.src = "public/img/sprites/road.jpg";

    // спрайты выстрелов на карте
    const imgShot = new Image();
    imgShot.src = "public/img/sprites/shot.png";

    const SIZE = 57;
    const stdSprite = [
        { x: 0, y: 0 },
        { x: SIZE, y: 0 },
        { x: SIZE*2, y: 0 },
        { x: SIZE*3, y: 0 },
        { x: SIZE*4, y: 0 },
        { x: 0, y: SIZE },
        { x: SIZE, y: SIZE },
        { x: SIZE*2, y: SIZE },
        { x: SIZE*3, y: SIZE },
        { x: SIZE*4, y: SIZE }
    ];
    const SPRITES = {
        grass: {
            img: imgGrass,
            sprite: stdSprite
        },
        road: {
            img: imgRoad,
            sprite: stdSprite
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
                { x: 80, y: 0},
                { x: 160, y: 0},
                { x: 240, y: 0}
            ]
        },
        shot: {
            img: imgShot,
            sprite: [
                { x: 0, y: 0 },
                { x: 80, y: 0},
                { x: 160, y: 0},
                { x: 240, y: 0}
            ]
        }
    };

    function printSprite(tile, x, y) {
        if (tile && tile.type && tile.sprite) {
            const sprite = SPRITES[tile.type];
            canvas.sprite(
                sprite.img,
                sprite.sprite[tile.sprite].x, sprite.sprite[tile.sprite].y, SIZE*5, SIZE*5,
                x * SIZE, y * SIZE, SIZE, SIZE);
        }
    }

    function printTowerSprite(tower) {
        if(tower && tower.type) {
            const sprite = SPRITES.tower;
            canvas.sprite(sprite.img,
                sprite.sprite[tower.type].x, sprite.sprite[tower.type].y, 256, 454,
                tower.x * SIZE, tower.y * SIZE, SIZE, SIZE);
        }
    }

    function printMobSprite(mob) {
        if (mob && mob.type) {
            const sprite = SPRITES.mob;
            canvas.sprite(sprite.img,
                sprite.sprite[mob.type].x, sprite.sprite[mob.type].y, 171, 270,
                mob.x * SIZE, mob.y * SIZE, SIZE, SIZE);
        }
    }

    function printShotSprite(shot) {
        if(shot && shot.type) {
            const sprite = SPRITES.shot;
            canvas.sprite(sprite.img,
                sprite.sprite[shot.type].x, sprite.sprite[shot.type].y, 64, 64,
                shot.x * SIZE, shot.y * SIZE, SIZE, SIZE);
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
        //нарисовать выстрелы на карте
        data.shots.forEach(shot => printShotSprite(shot));
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

    function stopGame() {
        if (interval) {
            clearInterval(interval);
        }
    }

    function startGame() {
        stopGame();
        interval = setInterval(refresh, 100);
    }


    function canvasKeyPress(method) {
        $(document).on('keydown', async event => {
        if(method === 'addMob') {
                if(event.keyCode > 36 && event.keyCode < 41) {
                    server.moveMob(event.keyCode);
                };
        }
        else {
                if(event.keyCode > 36 && event.keyCode < 40) {
                    //var result = 
                    server.changeTower(event.keyCode);
                    //console.log(result);
                }
            };
        });
    }

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
                startGame();
                canvasKeyPress(method);
            } else {
                alert('Выбери сторону!');
            }
        });
    }
    init();
}