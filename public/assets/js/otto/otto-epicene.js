class OttoEpicene {


    static choose(attribute_name){
        let selector = `[${attribute_name}]`
        let label, gender

        document.querySelectorAll(selector).forEach((element) => {
            label = element.innerHTML
            gender = element.getAttribute(attribute_name)
            if(gender)
                element.innerHTML = this.replaceEpiceneLabel(label, gender)
        })
    }

    static replaceEpiceneLabel(label, gender) {
        if(gender !== 'h' && gender !== 'f'){
            console.log('no gender for this element')
            return label;
        }

        let search_and_replace = [
            {
                'test': /eur\(-euse\)/,
                'h': 'eur',
                'f': 'euse'
            },

            {
                'test': /teur\(-trice\)/,
                'h': 'teur',
                'f': 'trice'
            },

            {
                'test': /ler\(-lère\)/,
                'h': 'ler',
                'f': 'lère'
            },

            {
                'test': /ier\(-ière\)/,
                'h': 'ier',
                'f': 'ière'
            },

            {
                'test': /\(e\)/,
                'h': '',
                'f': 'e'
            },
            {
                'test': /\(wo\)/,
                'h': '',
                'f': 'wo'
            },
            {
                'test': /\(fe\)/,
                'h': '',
                'f': 'fe'
            },
            {
                'test': /\(ne\)/,
                'h': '',
                'f': 'ne'
            }
        ]

        let regex
        search_and_replace.forEach((item) => {
            regex = item.test;
            if(regex.test(label)){
                regex = new RegExp(regex.source, regex.flags + 'g');

                label = label.replace(regex, item[gender]);
            }

        })

        
        return label;
    }
}

export default OttoEpicene;