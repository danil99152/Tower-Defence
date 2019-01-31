function Game(options) {

    const server = options.server;
    const callbacks = options.callbacks || {};

    const canvas = new Canvas(canvasKeyPress);

    let interval = null;

    //  TODO: Функция должна поворачивать спрайт башен, но выдает ошибку связанную с jquery - исправить
    // (function($) {
    //     $.fn.rotateImg = function(options) {
    //         var defaults = {deg : 0};
    //         var settings = $.extend( {}, defaults, options );
    //         return this.each(function() {
    //             var img = $(this).css({position: 'absolute'});
    //             var imgpos = img.position();
    //             var x0, y0;
    //             $(window).load(function() {
    //                 x0 = imgpos.left + img.width() / 2;
    //                 y0 = imgpos.top + img.height() / 2
    //             });
    //             var x, y, x1, y1, r;
    //             $("html").mousemove(function(e) {
    //                 x1 = e.pageX;
    //                 y1 = e.pageY;
    //                 x = x1 - x0;
    //                 y = y1 - y0;
    //                 r = 180 + settings.deg - 180 / Math.PI * Math.atan2(y, x);
    //                 img.css("transform", "rotate(-" + r + "deg)");
    //                 img.css("-moz-transform", "rotate(-" + r + "deg)");
    //                 img.css("-webkit-transform", "rotate(-" + r + "deg)");
    //                 img.css("-o-transform", "rotate(-" + r + "deg)")
    //             })
    //         })
    //     }
    // })(jQuery);

    // картинка с травой
    const imgGrass = new Image();
    imgGrass.src = "public/img/sprites/grass.png";

    // спрайты башен на карте
    const imgTower = new Image();
    imgTower.src = "public/img/sprites/towers_160x160.png";
    //$('imgTower').rotateImg({deg : 0});

    // спрайты мобов на карте
    const imgMob = new Image();
    imgMob.src = "public/img/sprites/mob_50x90.png";

    // спрайты дорог на карте
    const imgRoad = new Image();
    imgRoad.src = "public/img/sprites/road.jpg";

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
                sprite.sprite[tower.type - 0].x, sprite.sprite[tower.type - 0].y, 256, 454,
                tower.x * SIZE, tower.y * SIZE, SIZE, SIZE);
        }
    }

    function printMobSprite(mob) {
        if (mob && mob.type) {
            const sprite = SPRITES.mob;
            canvas.sprite(sprite.img,
                sprite.sprite[mob.type - 0].x, sprite.sprite[mob.type - 0].y, 171, 270,
                mob.x * SIZE, mob.y * SIZE, SIZE, SIZE);
        }
    }

    function printRoadSprite(road) {
        if(road && road.type) {
            const sprite = SPRITES.road;
            canvas.sprite(sprite.img,
                sprite.sprite[road.type - 0].x, sprite.sprite[road.type - 0].y, SIZE, SIZE,
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

    function stopGame() {
        if (interval) {
            clearInterval(interval);
        }
    }

    function startGame() {
        stopGame();
        interval = setInterval(refresh, 1000);
    }


    function canvasKeyPress() {
        $(document).on('keydown', async event => {
            switch (event.keyCode) {
                case 37:
                    const left = await server.moveMob('LEFT');
                    if (left.result) {
                        render(left.data);
                        console.log("Влево");
                    } break; //влево
                case 38:
                    const up = await server.moveMob('UP');
                    if (up.result) {
                        render(up.data);
                        console.log("Вверх");
                    } break; //вверх
                case 39:
                    const right = await server.moveMob('RIGHT');
                    if (right.result) {
                        render(right.data);
                        console.log("Вправо");
                    } break; //вправо
                case 40:
                    const down = await server.moveMob('DOWN');
                    if (down.result) {
                        render(down.data);
                        console.log("Вниз");
                    } break; //вниз
            }
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
                canvasKeyPress();
            } else {
                alert('Выбери сторону!');
            }
        });
    }
    init();
}