$(document).ready(function () {

    $(":submit").on("click", function(e) {
        var id = $(this).closest("form").attr("id");
        if (id === "mercury-payment-form") {
            e.preventDefault();
            $("body").prepend("<div id=\"mercury-cash\"></div>");
            var url            = $("input[name='url']").val();
            var statusUrl      = $("input[name='status_url']").val();
            var staticUrl      = $("input[name='static_url']").val();
            var getSettingsUrl = $("input[name='get_settings_url']").val();
            var successUrl     = $("input[name='success_url']").val();
            var refreshPeriod  = $("input[name='refresh_period']").val() * 1000;

            $.ajax({
                ajax: 1,
                url: getSettingsUrl,
                type: "post",
                dataType: "json",
                success(data) {
                    var price       = data.price;
                    var currency    = data.currency;
                    var minimumBtc  = data.minimum_btc;
                    var minimumEth  = data.minimum_eth;
                    var minimumDash = data.minimum_dash;
                    var email       = data.email;

                    var sdk = new MercurySDK({
                        checkoutUrl: url,
                        statusUrl: statusUrl,
                        staticUrl: staticUrl,
                        checkStatusInterval: refreshPeriod,
                        mount: "#mercury-cash",
                        lang: "en",
                        limits: {
                            BTC:  minimumBtc,
                            ETH:  minimumEth,
                            DASH: minimumDash
                        }
                    });
                    sdk.checkout(price, currency, email);
                    sdk.on("close", (obj) => {
                        if(obj.status && obj.status === "TRANSACTION_APROVED") {
                            $("body").addClass("loading");
                            $.ajax({
                                ajax: 1,
                                url: successUrl,
                                type: "post",
                                dataType: "json",
                                success(data) {
                                    $("body").removeClass("loading");
                                    if (data.result == true) {
                                        var url = data.url;
                                        window.location.href = url;
                                    } else {
                                        $("#mercury-cash").remove();
                                        $("#errorModalLabel").html(data.error);
                                        $("#errorModal").modal("toggle");
                                    }
                                },
                                error(jqXHR, exception) {
                                    $("body").removeClass("loading");
                                    var msg = "Uncaught Error.\n" + jqXHR.responseText;
                                    if (jqXHR.status === 500) {
                                        msg = "Internal Server Error [500].";
                                    } else if (exception === "parsererror") {
                                        msg = "Requested JSON parse failed.";
                                    } else if (exception === "timeout") {
                                        msg = "Time out error.";
                                    } else if (exception === "abort") {
                                        msg = "Ajax request aborted.";
                                    }
                                    $("#errorModalLabel").html(msg);
                                    $("#errorModal").modal("toggle");
                                }
                            });
                        }
                    });
                },
                error(jqXHR, exception) {
                    var msg = "Uncaught Error.\n" + jqXHR.responseText;
                    if (jqXHR.status === 500) {
                        msg = "Internal Server Error [500].";
                    } else if (exception === "parsererror") {
                        msg = "Requested JSON parse failed.";
                    } else if (exception === "timeout") {
                        msg = "Time out error.";
                    } else if (exception === "abort") {
                        msg = "Ajax request aborted.";
                    }
                    $("#errorModalLabel").html(msg);
                    $("#errorModal").modal("toggle");
                }
            });
            return false;
        }
    });

});