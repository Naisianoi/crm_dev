$(document).ready(function() {
    $("#service-jc-search-input").on("keyup", function() {
        var search = $(this).val();
        if (search !== "") {
            $.ajax({
                url: "service-jc-phone-results.php",
                method: "POST",
                data: { search: search },
                success: function(data) {
                    $("#service-jc-search-results").html(data);
                }
            });
        } else {
            $("#service-jc-search-results").html("");
        }
    });
  });
  
  function redirectToSearchPage(event) {
    if (event.keyCode === 13) { // Check if Enter key is pressed
        var searchValue = document.getElementById("service-jc-search-input").value;
        if (searchValue !== "") {
            window.location.href = "service-jc-phone-search.php?search=" + encodeURIComponent(searchValue);
        }
    }
  }