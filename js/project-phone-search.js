$(document).ready(function() {
    $("#project-search-input").on("keyup", function() {
        var search = $(this).val();
        if (search !== "") {
            $.ajax({
                url: "project-phone-results.php",
                method: "POST",
                data: { search: search },
                success: function(data) {
                    $("#project-search-results").html(data);
                }
            });
        } else {
            $("#project-search-results").html("");
        }
    });
  });
  
  function redirectToSearchPage(event) {
    if (event.keyCode === 13) { // Check if Enter key is pressed
        var searchValue = document.getElementById("project-search-input").value;
        if (searchValue !== "") {
            window.location.href = "project-phone-search.php?search=" + encodeURIComponent(searchValue);
        }
    }
  }