class Click {
  constructor() {
    this.formId = document.querySelector("#formular");
    this.formBtn = document.querySelector("#form-btn");
    this.menuBtn = document.querySelector("#menu-btn");
    this.menuItems = document.querySelectorAll(".site-header__menu-item");
    this.menuUncheck();
    // this.formSubmit();
  }

  menuUncheck() {
    this.menuItems.forEach((menuItem) => {
      menuItem.addEventListener("click", () => {
        this.menuBtn.checked = false;
      });
    });
  }

  // formSubmit() {
  //   this.formBtn.addEventListener("click", (e) => {
  //     e.preventDefault(this.formId.submit());
  //   });
  // }
}

export default Click;
