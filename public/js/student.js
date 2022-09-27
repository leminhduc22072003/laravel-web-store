$.get('/ajax-get-child-category', function (data) {
    Highcharts.chart('child-category', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Thống kê học sinh toàn tỉnh'
        },
        subtitle: {
            text: 'Đơn vị: người'
        },
        xAxis: {
            categories: data['district'],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Đơn vị: (người)'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:1f} người</b></td></tr>',
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
        buttons: {
            contextButton: {
                menuItems: ['downloadCSV', 'downloadJPEG', 'downloadPDF', 'downloadPNG','downloadSVG', 'downloadXLS', 'viewData', 'viewFullscreen', 'printChart']
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
    });
});

$.get('/ajax-get-child-category-2', function (data) {
    Highcharts.chart('student2', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Thống kê học sinh theo giới tính'
        },
        subtitle: {
            text: 'Đơn vị: người'
        },
        xAxis: {
            categories: ['Nam', 'Nữ'],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Đơn vị: (người)'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:1f} người</b></td></tr>',
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
        buttons: {
            contextButton: {
                menuItems: ['downloadCSV', 'downloadJPEG', 'downloadPDF', 'downloadPNG','downloadSVG', 'downloadXLS', 'viewData', 'viewFullscreen', 'printChart']
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
    });
});
