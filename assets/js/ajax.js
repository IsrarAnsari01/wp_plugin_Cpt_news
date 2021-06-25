jQuery(document).ready(($) => {
  // Add New News
  let formDiv = $("#addPostUsingRestApi");
  let submitForm = formDiv.find("form");
  submitForm.submit((e) => {
    e.preventDefault();
    let newsTitle = submitForm.find("#newsTitle").val();
    let newsType = submitForm.find("#newsTypes").val();
    let reporterName = submitForm.find("#reporterName").val();
    let reporterCity = submitForm.find("#reporterCity").val();
    let reporterGender = submitForm.find("#reporterGender").val();
    let newsContent = submitForm.find("#newsContent").val();
    let data = {
      newsTitle,
      newsType,
      reporterName,
      reporterCity,
      reporterGender,
      newsContent,
      action: "add_new_news",
    };
    jQuery.ajax({
      url: submit_News_obj.siteUrl+"/add-new-news",
      method: "POST",
      data: data,
      caches: false,
      dataType: "json",
      encode: true,
      success: function (response) {
        if (response) {
          alert("Successfully save new News");
        } else {
          alert("Error in saving new News");
        }
      },
      error: function (jqXHR, error, errorThrown) {
        console.log("Error in finding news");
      },
    });
  });
  // Delete News
  let deleteParentDiv = $("#forDelete");
  let formInsideDeleteDiv = deleteParentDiv.find("form");
  formInsideDeleteDiv.submit((e) => {
    e.preventDefault();
    const postId = formInsideDeleteDiv.find("#submit").attr("postId");
    let posted_id = { postId, action: "delete_news" };
    jQuery.ajax({
      url: submit_News_obj.siteUrl,
      method: "POST",
      data: posted_id,
      caches: false,
      dataType: "json",
      encode: true,
      success: function (response) {
        if (response) {
          alert("Deleted Successfully");
        } else {
          alert("Error in deleting news");
        }
      },
      error: function (jqXHR, error, errorThrown) {
        console.log("Error in finding news");
      },
    });
  });
  // For Update
  let forUpdate = $("#forUpdate");
  let updateForm = forUpdate.find("form");
  updateForm.submit((e) => {
    e.preventDefault();
    let newsTitle = updateForm.find("#newsTitle").val();
    let newsType = updateForm.find("#newsTypes").val();
    let reporterName = updateForm.find("#reporterName").val();
    let reporterCity = updateForm.find("#reporterCity").val();
    let reporterGender = updateForm.find("#reporterGender").val();
    let newsContent = updateForm.find("#newsContent").val();
    let postId = updateForm.find("#submit").attr("postId");
    let dataToBeUpdated = {
      postId,
      newsTitle,
      newsType,
      reporterName,
      reporterCity,
      reporterGender,
      newsContent,
      action: "update_news",
    };
    jQuery.ajax({
      url: submit_News_obj.siteUrl,
      method: "POST",
      data: dataToBeUpdated,
      caches: false,
      dataType: "json",
      encode: true,
      success: function (response) {
        if (response) {
          alert("Update news successfully");
        } else {
          alert("Error in updating news");
        }
      },
      error: function (jqXHR, error, errorThrown) {
        console.log("Error in finding news");
      },
    });
  });
});
