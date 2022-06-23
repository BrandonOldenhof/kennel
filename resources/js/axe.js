import axe from "axe-core";

window.addEventListener("load", () => {
  axe
    .run()
    .then((results) => {
      if (results.violations.length) {
        console.log(results.violations);
        throw new Error("Accessibility issues found");
      }
    })
    .catch((err) => {
      console.error("Something bad happened:", err.message);
    });
});
