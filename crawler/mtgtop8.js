const fetch = require('node-fetch');
const cheerio = require('cheerio');
// const iconv = require('iconv-lite');
// const jquery = require("jquery");
// const jsdom = require("jsdom");
// const {JSDOM} = jsdom;


async function fetchEventInfo(eventId) {
    let eventPromise = fetch('http://mtgtop8.com/event?e=' + eventId)
        .then(res => res.text())
        .then((res => {
            // const {window} = new JSDOM(res);
            // const $ = jquery(window);
            const $ = cheerio.load(res);
            let players;
            let date;
            let centralDivs = $('table div table td[align=center] div');
            let data = centralDivs[1].prev.data.trim();
            let playersRE = /^(\d*) players/;
            let dateRE = /(\d\d\/\d\d\/\d\d)$/;
            if (data.match(playersRE)) players = parseInt(data.match(playersRE)[1]);
            if (data.match(dateRE)) date = data.match(dateRE)[1];
            let result = {
                title: $('.w_title td').first().text(),
                format: centralDivs[0].prev.data.trim(),
                stars: $('table div table td[align=center] div img[src="graph/star.png"]').length,
                bigstars: $('table div table td[align=center] div img[src="graph/bigstar.png"]').length,
                players: players,
                date: date,
                decks: []
            };
            $('table td[width="25%"] > div > div:not([align="center"])').each(function (i, div) {
                let link = $($('div div a', div)[0]).attr('href');

                result.decks.push({
                    result: $('div div[align=center]', div).text().trim(),
                    title: $($('div div a', div)[0]).text().trim(),
                    player: $($('div div a', div)[1]).text().trim(),
                    id: parseInt(link.match(/\&d\=(\d*)/)[1])
                });
            });
            result.players = result.players || result.decks.length;

            // console.log(result);
            return result;
        }))
    return await eventPromise;
}

// fetch('https://github.com/')
//     .then(res => res.text())
//     .then(body => console.log(body));

fetchEventInfo(1)
    .then(res => console.log(res));
