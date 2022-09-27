$.get('/ajax-get-school', function (data) {
    Highcharts.chart('school', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Thống kê cơ sở giáo dục toàn tỉnh'
        },
        subtitle: {
            text: 'Đơn vị: trường'
        },
        xAxis: {
            categories: data['district'],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Đơn vị: (trường)'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:1f} trường</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Mầm non',
            data: data['nursery']

        }, {
            name: 'Tiểu học',
            data: data['primary']

        }, {
            name: 'THCS',
            data: data['junior_high']

        }, {
            name: 'THPT',
            data: data['high']

        }, {
            name: 'Tiểu học/ THCS',
            data: data['primary_junior_high']

        }, {
            name: 'THCS/ THPT',
            data: data['junior_and_high']

        }, {
            name: 'Giáo dục thường xuyên',
            data: data['cec']

        }],
        buttons: {
            contextButton: {
                menuItems: ['downloadCSV', 'downloadJPEG', 'downloadPDF', 'downloadPNG','downloadSVG', 'downloadXLS', 'viewData', 'viewFullscreen', 'printChart']
            }
        }
    });
});

$.get('/ajax-get-school-2', function (data) {
    Highcharts.chart('school2', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Thống kê cơ sở giáo dục trong 10 năm gần đây'
        },
        subtitle: {
            text: 'Đơn vị: trường'
        },
        xAxis: {
            categories: data['year'],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Đơn vị: (trường)'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:1f} trường</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Mầm non',
            data: data['nursery']

        }, {
            name: 'Tiểu học',
            data: data['primary']

        }, {
            name: 'THCS',
            data: data['junior_high']

        }, {
            name: 'THPT',
            data: data['high']

        }, {
            name: 'Tiểu học/ THCS',
            data: data['primary_junior_high']

        }, {
            name: 'THCS/ THPT',
            data: data['junior_and_high']

        }, {
            name: 'Giáo dục thường xuyên',
            data: data['cec']

        }],
        buttons: {
            contextButton: {
                menuItems: ['downloadCSV', 'downloadJPEG', 'downloadPDF', 'downloadPNG','downloadSVG', 'downloadXLS', 'viewData', 'viewFullscreen', 'printChart']
            }
        }
    });
});
