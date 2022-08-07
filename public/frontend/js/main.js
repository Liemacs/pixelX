$(document).ready(function () {
    $("#viewAll").on("click", function () {
        if (!$(".category").hasClass("inactive")) {
            $(".category").each(function (index) {
                if (index > 2) {
                    $(".category:nth-child(" + (index + 1) + ")").addClass(
                        "inactive"
                    );
                }
            });
        } else {
            $(".category").removeClass("inactive");
        }
    });
});

document.querySelectorAll(".add_to_cart").forEach((button) =>
    button.addEventListener("click", (e) => {
        if (!button.classList.contains("loading")) {
            button.classList.add("loading");

            setTimeout(() => button.classList.remove("loading"), 3700);
        }
        e.preventDefault();
    })
);