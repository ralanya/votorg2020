"use strict";
$(document).ready(function(){
	// Single Search Select
    $(".js-example-basic-single").select2();
    $(".js-example-disabled-results").select2();
    // Multi Select


    // With Placeholder
    $(".js-example-placeholder-multiple").select2({
        placeholder: "Select Your Name"
    });


    // Tagging Suppoort
    $(".js-example-tags").select2({
        tags: true
    });

    // Automatic tokenization
    $(".js-example-tokenizer").select2({
        tags: true,
        tokenSeparators: [',', ' ']
    });

    // Loading Array Data
    var data = [{
        id: 0,
        text: 'enhancement'
    }, {
        id: 1,
        text: 'bug'
    }, {
        id: 2,
        text: 'duplicate'
    }, {
        id: 3,
        text: 'invalid'
    }, {
        id: 4,
        text: 'wontfix'
    }];

    $(".js-example-data-array").select2({
        data: data
    });

    //RTL Suppoort

    $(".js-example-rtl").select2({
        dir: "rtl"
    });
    // Diacritics support
    $(".js-example-diacritics").select2();

    // Responsive width Search Select
    $(".js-example-responsive").select2();

    $(".js-example-basic-hide-search").select2({
        minimumResultsForSearch: Infinity
    });

    $(".js-example-disabled").select2({
        disabled: true
    });
    $(".js-programmatic-enable").on("click", function() {
        $(".js-example-disabled").prop("disabled", false);
    });
    $(".js-programmatic-disable").on("click", function() {
        $(".js-example-disabled").prop("disabled", true);
    });

    $(".js-example-theme-single").select2({
        theme: "classic"
    });

    function formatRepo(repo) {
        if (repo.loading) return repo.text;

        var markup = "<div class='select2-result-repository clearfix'>" +
            "<div class='select2-result-repository__avatar'><img src='" + repo.owner.avatar_url + "' /></div>" +
            "<div class='select2-result-repository__meta'>" +
            "<div class='select2-result-repository__title'>" + repo.full_name + "</div>";

        if (repo.description) {
            markup += "<div class='select2-result-repository__description'>" + repo.description + "</div>";
        }

        markup += "<div class='select2-result-repository__statistics'>" +
            "<div class='select2-result-repository__forks'><i class='icofont icofont-flash'></i> " + repo.forks_count + " Forks</div>" +
            "<div class='select2-result-repository__stargazers'><i class='icofont icofont-star'></i> " + repo.stargazers_count + " Stars</div>" +
            "<div class='select2-result-repository__watchers'><i class='icofont icofont-eye-alt'></i> " + repo.watchers_count + " Watchers</div>" +
            "</div>" +
            "</div></div>";

        return markup;
    }

    function formatRepoSelection(repo) {
        return repo.full_name || repo.text;
    }

    
    
	// Multi-select js start

    // Single Select
    // $('#example-single').multiselect();

    // // Multi Select
    // $('#example-multiple-selected').multiselect();

    // // Multi Group Select
    // $('#example-multiple-optgroups').multiselect();

    // // Select all group select
    // $('#example-enableClickableOptGroups').multiselect({
    //     enableClickableOptGroups: true
    // });

    // // Disable Options Select
    // $('#example-enableClickableOptGroups-init').multiselect({
    //     enableClickableOptGroups: true
    // });

    // // Collapse group select
    // $('#example-enableCollapsibleOptGroups').multiselect({
    //     enableCollapsibleOptGroups: true
    // });



});