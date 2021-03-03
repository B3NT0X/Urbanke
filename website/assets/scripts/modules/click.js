class Click {
  constructor() {
    this.menuBtn = document.querySelector("#menu-btn");
    this.menuItems = document.querySelectorAll(".site-header__menu-item");
    this.menuUncheck();
  }

  menuUncheck() {
    this.menuItems.forEach((menuItem) => {
      menuItem.addEventListener("click", () => {
        this.menuBtn.checked = false;
      });
    });
  }

}

export default Click;
