const readline = require('readline');

const rl = readline.createInterface({
    input: process.stdin,
    output: process.stdout
});

rl.question('Enter the flag: ', (flag) => {
    let flagArray = Buffer.from(flag);
    for (let i = 0; i < 16; i++) {
        switch (i % 4) {
            case 0:
                flagArray[i] ^= flagArray[i + 1];
                break;
            case 1:
                flagArray[i] ^= flagArray[i - 1];
                break;
            case 2:
                flagArray[i] ^= 0x13;
                break;
            case 3:
                flagArray[i] ^= 0x37;
                break;
        }
    }

    const temp = flagArray[8];
    flagArray[8] = flagArray[3];
    flagArray[3] = temp;

    flagArray.reverse();

    const rev = Buffer.from([0x76, 0x65, 0x45, 0x4c, 0x70, 0x47, 0x06, 0x61, 0x53, 0x4e, 0x41, 0x27, 0x5f, 0x35, 0x30, 0x60, 0x65, 0x51]);
    for (let j = 0; j < 17; j++) {
        if (rev[j] !== flagArray[j]) {
            process.exit(1);
        }
    }

    console.log('Correct flag!');
    rl.close();
});
