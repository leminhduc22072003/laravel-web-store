$.get('/ajax-get-personnel', function (data) {
    Highcharts.chart('personnel', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Thông kê nhân viên giáo dục toàn tỉnh'
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
        series: [{
            name: 'Cán bộ quản lý',
            data: data['product']

        }, {
            name: 'Giáo viên',
            data: data['category']

        }, {
            name: 'Nhân viên',
            data: data['employee']

        }]
    });
});

$.get('/ajax-get-personnel-2', function (data) {
    Highcharts.chart('personnel2', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Thông kê nhân viên giáo dục trong 10 năm gần đây'
        },
        subtitle: {
            text: 'Đơn vị: người'
        },
        xAxis: {
            categories: data['year'],
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
        series: [{
            name: 'Cán bộ quản lý',
            data: data['product']

        }, {
            name: 'Giáo viên',
            data: data['category']

        }, {
            name: 'Nhân viên',
            data: data['employee']

        }],
        buttons: {
            contextButton: {
                menuItems: ['downloadCSV', 'downloadJPEG', 'downloadPDF', 'downloadPNG','downloadSVG', 'downloadXLS', 'viewData', 'viewFullscreen', 'printChart']
            }
        }
    });
});

$.get('/ajax-get-personnel-3', function (data) {
    Highcharts.chart('personnel3', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Thông kê nhân viên giáo dục theo giới tính'
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
        series: [{
            name: 'Cán bộ quản lý',
            data: data['product']

        }, {
            name: 'Giáo viên',
            data: data['category']

        }, {
            name: 'Nhân viên',
            data: data['employee']

        }],
        buttons: {
            contextButton: {
                menuItems: ['downloadCSV', 'downloadJPEG', 'downloadPDF', 'downloadPNG','downloadSVG', 'downloadXLS', 'viewData', 'viewFullscreen', 'printChart']
            }
        }
    });
});


