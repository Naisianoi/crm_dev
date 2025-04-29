$(document).ready(function() {
    $("#trading-jc-search-input").on("keyup", function() {
        var search = $(this).val();
        if (search !== "") {
            $.ajax({
                url: "trading-jc-phone-results.php",
                method: "POST",
                data: { search: search },
                success: function(data) {
                    $("#trading-jc-search-results").html(data);
                }
            });
        } else {
            $("#trading-jc-search-results").html("");
        }
    });
  });
  
  function redirectToSearchPage(event) {
    if (event.keyCode === 13) { // Check if Enter key is pressed
        var searchValue = document.getElementById("trading-jc-search-input").value;
        if (searchValue !== "") {
            window.location.href = "trading-jc-phone-search.php?search=" + encodeURIComponent(searchValue);
        }
    }
  }