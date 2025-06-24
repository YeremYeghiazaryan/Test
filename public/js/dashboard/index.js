function delete_website(button) {
    let website_id = $(button).data('website-id');
    $.ajax({
        method: "POST",
        url: '/api/website/destroy',
        data: {
            'website_id': website_id,
        },
        success: function (response) {
            if (response.status === true) {
                alert(response.message);
                $("#websites #website_" + website_id).remove();
            } else {
                alert(response.message);
            }
        },
        error: function (response) {
            alert("Error Delete");
        }
    });
}

$(document).ready(function () {
    $.ajax({
        method: "GET",
        url: '/api/website/show',
        headers: {
            Authorization: "Bearer " + getCookie('auth_token')
        },
        success: function (response) {
            if (response.status === true) {
                let datas = response.data
                let website = ""
                for (let data of datas) {
                    website += `
                                 <tr id = website_${data.id}>
                                    <th scope="row">${data.id}</th>
                                    <td>${data.name}</td>
                                    <td>${data.created_at}</td>
                                    <td>
                                        <a class="btn btn-success" href="/website/show/${data.id}"><i class="fa-solid fa-eye"></i></a>
                                        <a class="btn btn-warning text-light" href="/website/edit/${data.id}" ><i class="fa-solid fa-pen-to-square"></i></a>
                                        <button onclick="delete_website(this)" type="submit"  data-website-id="${data.id}" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                    </td>
                                </tr>
                        `
                    $("#websites").html(website);
                }
            }
        },
        error: function () {
            alert("Error Show");
        }
    });

});
