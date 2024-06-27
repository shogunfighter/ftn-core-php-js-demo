// // for testing - good record
// window.cheat1 = function fillWithPositiveRecord() {
//     $("input#username").val("usera");
//     $("input#email").val("usera@sample.com");
//     $("input#password").val("123456789aB!");
//     $("input#birthdate").val("2021-01-01"); // YYYY-MM-DD
//     $("input#phone_number").val("1234567891");
//     $("input#url").val("http://abc.com");
// }

// // for testing - bad record
// window.cheat2 = function fillWithNegativeRecord() {
//     $("input#username").val("usera");
//     $("input#email").val("usera@sample.com");
//     $("input#password").val("123456789"); // ---------- this will fail here
//     $("input#birthdate").val("2021-01-01"); // YYYY-MM-DD
//     $("input#phone_number").val("1234567891");
//     $("input#url").val("http://abc.com");
// }

(function ($) {
  "use strict";





  window.submitRecord = function (
    username,
    email,
    password,
    birthdate,
    phone_number,
    url
  ) {
    console.log("submitRecord--------------");
    const requestData = {
      username,
      email,
      password,
      birthdate,
      phone_number,
      url,
    };

    console.log("requestData:",JSON.stringify(requestData));
    $.ajax({
      url: "./view/register.php",
      method: "POST",
      data: requestData,
    })
      .done((response) => {
        alert(response);
      })
      .fail(() => {
        console.error("Error submitting user registration form");
      });
  }

  function formatDate(date) {
    // const date = new Date();
    const d = new Date(date);
    const year = d.getFullYear();
    const month = String(d.getMonth() + 1).padStart(2, '0');
    const day = String(d.getDate()).padStart(2, '0');
    
    const formattedDate = `${year}-${month}-${day}`;
    // console.log(formattedDate);
    return formattedDate;
  }

  window.runTest = function () {
    function generateCombinations() {
      const keys = Object.keys(lists);
      const combinations = [];

      function generateCombination(index, combination) {
        if (index >= keys.length) {
          combinations.push(combination);
          return;
        }

        const key = keys[index];
        const values = lists[key].ok.concat(lists[key].bad);

        values.forEach((value) => {
          const newCombination = { ...combination };
          if (lists[key].bad.includes(value)) {
            newCombination.fail = true;
          }
          newCombination[key] = value;
          generateCombination(index + 1, newCombination);
        });
      }

      generateCombination(0, {});

      return combinations;
    }

    const lists = {
      username_list: {
        ok: ["gbggroup", "useraaaaaa", "userbbbbbb"],
        bad: ["gbg_group12", "gbg group"],
      },
      email_list: {
        ok: ["gbg@gbg-group.net"],
        bad: ["gbg@group", "gbg_group.net"],
      },
      password_list: {
        ok: ["11111aA~", "a11111A!", "!11A111a", "b11C111~", "#11C111a"],
        bad: [
          "a",
          "aaa",
          "1",
          "!",
          "!a",
          "!Aa",
          "!Aa1",
          "!Aa11",
          "!Aa111",
          "!Aa1111",
        ],
      },
      birthdate_list: {
        ok: [new Date()],
        bad: ["84/56/0"],
      },
      url_list: {
        ok: ["gigsberg.com"],
        bad: ["gigsbergcom"],
      },
      phone_number_list: {
        ok: ["1111111111"],
        bad: ["11111111111", "111111111a", "a", "111"],
      },
    };

    const combinations = generateCombinations();
    console.log(combinations);
    console.log("not fail:", combinations.filter((i) => !i?.fail));
    console.log("fail:", combinations.filter((i) => i?.fail));



    const testItem = combinations
    .filter((i) => !i?.fail);

    combinations
      .filter((i) => !i?.fail)
      .forEach(i => {
        const { username_list, email_list, password_list, birthdate_list, phone_number_list, url_list } = i;

        // console.log(`${JSON.stringify(i)}`, () => {
        //     submitRecord(username_list, email_list, password_list, birthdate_list, phone_number_list, url_list);
        // });

        submitRecord(username_list, email_list, password_list, formatDate(birthdate_list), phone_number_list, url_list);
      });

    // console.log(`${JSON.stringify(testItem[0])}`, testItem[0]);
    // console.log(`date `, formatDate(testItem[0].birthdate_list));

    // submitRecord(
    //     testItem[0].username_list,
    //     testItem[0].email_list,
    //     testItem[0].password_list,
    //     formatDate(testItem[0].birthdate_list),
    //     testItem[0].phone_number_list,
    //     testItem[0].url_list
    // );





    // for (const [listName, { ok, bad }] of Object.entries(lists)) {

    //     console.log(`${listName}`);

    //     // ok.forEach(item => {
    //     //     console.log(`${listName} - ${item} is good`, () => {
    //     //         submitForm(item, item, item, item, item, item);
    //     //     });
    //     // });

    //     // bad.forEach(item => {
    //     //     console.log(`${listName} - ${item} is bad`, () => {
    //     //         submitForm(item, item, item, item, item, item);
    //     //     });
    //     // });
    // }
  };
})(jQuery);
