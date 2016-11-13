// -------------------------------------------------------------------------
// <copyright company="BrainStation 23 Ltd.">
//     Copyright (c) 2016 [BrainStation 23 Ltd.](http://brainstation-23.com/)
// </copyright>
// <updated>29-04-2016</updated>
// <author>Mahbubur Rahman Manik</author>
// -------------------------------------------------------------------------

(function(extend) {
    extend.showPersonalizationPopup = function() {
        $('#personalizeDataTable tbody').html('');
        var row = '<tr>' +
            '<td>1</td>' +
            '<td><input type="text" disabled placeholder="Enter Name"></td>' +
            '<td><input type="text" disabled placeholder="Enter #"></td>' +
            '<td>' +
            '<select>' +
            '<option selected disabled>select product size</option>' +
            '<option>S(small) White Glidan cotton </option>' +
            '<option>M(medium) White Glidan cotton </option>' +
            '<option>L(large) White Glidan cotton </option>' +
            '<option>XL(extra-large) White Glidan cotton </option>' +
            '<option>2XL(double-extra-large) White Glidan cotton </option>' +
            '</select>' +
            '</td>' +
            '</tr>';
        $('#personalizeDataTable tbody').append(row);
        $('#personalizeDataTable tbody tr:nth-child(1) td:nth-child(2) input').prop('disabled', !addName.checked);
        $('#personalizeDataTable tbody tr:nth-child(1) td:nth-child(3) input').prop('disabled', !addNumber.checked);

    };

    extend.addPersonalizedName = function() {
        var personalizeName = new fabric.Text('SAMPLE', {
            left: canvas.getWidth() / 2 - 30,
            top: canvas.getHeight() / 2 - 30,
            fontFamily: 'impact',
            fontSize: 32,
            id: 'customName'
        });
        window.canvas.add(personalizeName).renderAll();
        this.personalizeObjects.push(personalizeName);
    };

    extend.removePersonalizedName = function() {
        if (window.canvas.getObjects()) {
            $(window.canvas.getObjects()).each(function() {
                if (this.id === 'customName') {
                    window.canvas.remove(this);
                }
            });
        }
        $(this.personalizeObjects).each(function(item) {
            if (this.id === 'customName') {
                this.personalizeObjects.splice(item, 1);
            }
        })
    };

    extend.addPersonalizedNumber = function() {
        var personalizeNumber = new fabric.Text('00', {
            left: canvas.getWidth() / 2 - 30,
            top: canvas.getHeight() / 2 - 30,
            fontFamily: 'impact',
            fontSize: 32,
            //width:40,
            //height:40,
            id: 'customNumber'
        });
        personalizeNumber.setScaleX(1.5);
        personalizeNumber.setScaleY(1.5);
        window.canvas.add(personalizeNumber).renderAll();
        this.personalizeObjects.push(personalizeNumber);
    };

    extend.removePersonalizedNumber = function() {
        if (window.canvas.getObjects()) {
            $(window.canvas.getObjects()).each(function() {
                if (this.id === 'customNumber') {
                    window.canvas.remove(this);
                }
            });
        }
        $(this.personalizeObjects).each(function(item) {
            if (this.id === 'customNumber') {
                this.personalizeObjects.splice(item, 1);
            }
        })
    };

    extend.setPersonalizedNameColor = function(color) {
        if (window.canvas.getObjects()) {
            $(window.canvas.getObjects()).each(function() {
                if (this.id === 'customName') {
                    this.setFill(color);
                }
            });
        }
        window.canvas.renderAll();
    };

    extend.setPersonalizedNumberColor = function(color) {
        if (window.canvas.getObjects()) {
            $(window.canvas.getObjects()).each(function() {
                if (this.id === 'customNumber') {
                    this.setFill(color);
                }
            });
        }
        window.canvas.renderAll();
    };

    extend.setPersonalNameSize = function(inches) {
        if (window.canvas.getObjects()) {
            $(window.canvas.getObjects()).each(function() {
                if (this.id === 'customName') {
                    this.setScaleX(inches);
                    this.setScaleY(inches);
                }
            });
        }
        window.canvas.renderAll();
    };

    extend.setPersonalNumberSize = function(inches) {
        if (window.canvas.getObjects()) {
            $(window.canvas.getObjects()).each(function() {
                if (this.id === 'customNumber') {
                    this.set('scaleX', inches);
                    this.set('scaleY', inches);
                }
            });
        }
        window.canvas.renderAll();
    };

    extend.changeTshirtSideInPersonalizationMode = function(sideName) {
        window.canvas.clear();
        var imageSrc = 'scripts/TshirtDesignTool/img/' + this.selectedTShirt.color + '-1-' + sideName + '.jpg';
        var img = new Image();
        img.src = imageSrc;
        img.alt = sideName;
        img.onload = function() {
            window.canvas.setBackgroundImage(img.src, window.canvas.renderAll.bind(canvas), {
                originX: 'left',
                originY: 'top',
                left: 0,
                top: 0,
                width: canvas.getWidth(),
                height: canvas.getHeight()
            });
        };

        if (sideName === nameSide.value) {
            $(this.personalizeObjects).each(function() {
                if (this.id === 'customName') {
                    window.canvas.add(this).renderAll();
                }
            });
        }

        if (sideName === numberSide.value) {
            $(this.personalizeObjects).each(function() {
                if (this.id === 'customNumber') {
                    window.canvas.add(this).renderAll();
                }
            });
        }

    };

    extend.personalizeJsonData = {
        frontTemplate: null,
        backTemplate: null,
        memberList: []
    };

    extend.personalizeObjects = [];
})(TShirtDesignTool);