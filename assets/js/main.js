jQuery(document).ready(($) => {
  let parentDiv = $("#filterFormDiv");
  let formInsideParentDiv = parentDiv.find("form");
  let parentDivForContent = parentDiv.find("#totalNews");
  // Filteration using meta value and taxonomy
  formInsideParentDiv.submit((e) => {
    e.preventDefault();
    let newsType = formInsideParentDiv.find("#newsTypes").val();
    let metaValue = formInsideParentDiv.find("#metaValue").val();
    let data = { newsType, metaValue, action: "ajax_filter_search_cb" };
    jQuery.ajax({
      url: ajax_object.ajaxurl,
      method: "POST",
      data: data,
      caches: false,
      dataType: "json",
      encode: true,
      success: function (response) {
        if (response) {
          $("#totalNews").html(response);
        } else {
          let errorMsg = "<h2> Unable to find your desire job</h2>";
          $("#totalNews").html(errorMsg);
        }
      },
      error: function (jqXHR, error, errorThrown) {
        console.log("Error in finding news");
      },
    });
  });
  // Sorting news
  let sortingDiv = $("#sortingByTitle");
  let sortingForm = sortingDiv.find("form");
  sortingForm.submit((e) => {
    e.preventDefault();
    let sortingType = sortingForm.find("#sortingDropDown").val();
    let data = { sortingType, action: "ajax_filter_search_cb" };
    jQuery.ajax({
      url: ajax_object.ajaxurl,
      method: "POST",
      data: data,
      caches: false,
      dataType: "json",
      encode: true,
      success: function (response) {
        if (response) {
          $("#totalNews").html(response);
        } else {
          let errorMsg = "<h2> Unable to find your desire job</h2>";
          $("#totalNews").html(errorMsg);
        }
      },
      error: function (jqXHR, error, errorThrown) {
        console.log("Error in finding news");
      },
    });
  });
  //Keyword Search
  let keywordSearchDiv = $("#keywordSearch");
  let keywordSearcgForm = keywordSearchDiv.find("form");
  let keyword = keywordSearcgForm.find("#keyword");
  keyword.keyup((e) => {
    e.preventDefault();
    let keyword = keywordSearcgForm.find("#keyword").val();
    let data = { keyword, action: "ajax_filter_search_cb" };
    console.log(data);
    jQuery.ajax({
      url: ajax_object.ajaxurl,
      method: "POST",
      data: data,
      caches: false,
      dataType: "json",
      encode: true,
      success: function (response) {
        if (response) {
          $("#totalNews").html(response);
        } else {
          let errorMsg = "<h2> Unable to find your desire job</h2>";
          $("#totalNews").html(errorMsg);
        }
      },
      error: function (jqXHR, error, errorThrown) {
        console.log("Error in finding news");
      },
    });
  });
});
