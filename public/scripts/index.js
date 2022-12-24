const gamePlayersList = document.querySelector(".game-settings__players-list");
const addPlayerBtn = document.querySelector(".game-settings__add-player");

const addPlayer = () => {
    const playerEl = document.createElement("div");
    playerEl.classList.add("game-settings__player");

    playerEl.innerHTML = `
        <div class="game-settings__player-icon">
            <img src="/assets/person-inverted.svg" alt="player icon">
        </div>
        <input 
            class="input input--inverted" 
            type="text"
            name="players[]"
            placeholder="Playername"
        />
        <button class="game-settings__player-delete">
            <img src="/assets/trashcan.svg" alt="trashcan icon">
        </button>
    `;

    gamePlayersList.appendChild(playerEl);
};

if (addPlayerBtn) {
    addPlayerBtn.addEventListener("click", () => {
        addPlayer();
    });
}

const headerMenu = document.querySelector(".header-menu");
const settingsMenu = document.querySelector(".settings-menu");
const newRoundMenu = document.querySelector(".new-round-menu");
const deleteRoundMenu = document.querySelector(".delete-round-menu");

const overlay = document.querySelector(".overlay");

const menus = [headerMenu, settingsMenu, newRoundMenu, deleteRoundMenu];

const getMenuClass = (menu) => {
    return menu.classList[0];
};

const openMenu = (targetMenu) => {
    if (targetMenu.classList.contains(`${getMenuClass(targetMenu)}--open`)) {
        overlay.classList.remove("overlay--open");
        targetMenu.classList.remove(`${getMenuClass(targetMenu)}--open`);
        if (scoreboardBtns) scoreboardBtns.classList.add("scoreboard__btns--open");
    } else {
        menus.forEach((menu) => {
            if (menu) menu.classList.remove(`${getMenuClass(menu)}--open`);
        });

        if (scoreboardBtns) scoreboardBtns.classList.remove("scoreboard__btns--open");
        overlay.classList.add("overlay--open");
        targetMenu.classList.add(`${getMenuClass(targetMenu)}--open`);
    }
};

const headerMenuBtn = document.querySelector(".header__profile");
const settingsMenuBtn = document.querySelector(".header__settings-btn");
const scoreboardBtns = document.querySelector(".scoreboard__btns");

const openNewRoundMenuBtn = document.querySelector(".scoreboard__add-round");
const closeNewRoundMenuBtn = document.querySelector(".new-round-menu__close");

const openDeleteRoundBtn = document.querySelector(".scoreboard__delete-round");
const closeDeleteRoundBtn = document.querySelector(".delete-round-menu__close");

if (headerMenuBtn) {
    headerMenuBtn.addEventListener("click", () => {
        openMenu(headerMenu);
    });
}

if (settingsMenuBtn) {
    settingsMenuBtn.addEventListener("click", () => {
        openMenu(settingsMenu);
    });
}

if (openDeleteRoundBtn) {
    openDeleteRoundBtn.addEventListener("click", () => {
        openMenu(deleteRoundMenu);
    });

    closeDeleteRoundBtn.addEventListener("click", () => {
        openMenu(deleteRoundMenu);
    });
}

if (openNewRoundMenuBtn) {
    openNewRoundMenuBtn.addEventListener("click", () => {
        openMenu(newRoundMenu);
    });

    closeNewRoundMenuBtn.addEventListener("click", () => {
        openMenu(newRoundMenu);
    });
}
