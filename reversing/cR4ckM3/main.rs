use std::io;

fn main(){

    println!("Enter the flag: ");
    let mut input = String::new();
    io::stdin().read_line(&mut input);
    let user_input = input.to_string();
    let flag: Vec<u32> = user_input.chars().map(|c| c as u32).collect();    

    if input.trim().len() != 12 {
        println!("Wrong");
        return;
    }

    if (flag[11] ^ flag[2] - flag[3] % 20 != 29){
        return;
    }
    if (flag[7] * flag[2] & flag[7] ^ 2 * flag[11] != 189){
        return;
    } 
    if (flag[3] + flag[4] - flag[5] ^ flag[6] != 119){
        return;
    }
    if (flag[1] ^ flag[4] * flag[8] - flag[10] != 8979){
        return;
    }
    if (flag[6] % flag[0] + flag[1] - flag[9] != 36){
        return;
    }
    if (flag[6] - flag[10] ^ flag[5] + flag[3] != 239){
        return;
    }
    if (flag[4] & flag[3] % flag[11] + flag[2] != 19){
        return;
    }
    if (flag[0] ^ flag[10] + flag[6] - flag[4] != 80){
        return;
    }
    if (flag[5] + flag[9] - flag[8] + flag[7] != 191){
        return;
    }
    if (flag[0] + flag[9] ^ flag[8] + flag[10] != 113){
        return;
    }
    if (flag[5] % flag[0] + flag[11] - flag[8] != 99){
        return;
    }
    if (flag[2] + flag[1] & flag[9] * flag[7] != 144){
        return;
    }
    println!("Correct flag!!");
}