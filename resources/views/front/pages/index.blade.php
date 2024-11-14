@extends('front.layouts.master')


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/owl.carousel.min.js"></script>
<script async src="//www.instagram.com/embed.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<style>

:root {
  --size: 3;
  --skew: 7;
  --orange: hsl(20, 100%, 71%);
  --svgfilter: url(#squiggly-0);
  --boxshadow: rgb(22, 12, 3);
  --textshadow: rgb(42, 22, 23);
  --noise-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFAAAABQCAYAAACOEfKtAAAAAXNSR0IArs4c6QAACgtJREFUeF7tnGWIFl8Uxt8xsMUO7MAWO7DFDuxdscUOzCN2YAeuiR3YYu2q2IEtdmCLHdiBLdafPTDw0/ufL16/vXc/nb3cO+/M5T7nOec5Z8b79OmTJE6cOCoUCoVmzJghffv2VfvDhw+SNGlStXv06CFz585Ve86cOdKzZ09jfr58+eT69es6zmv269dPpk+fruM7duyQunXrqn3gwAGpWrWq2teuXZP8+fOrHRkZKevXr1d7yZIl0rFjR7VTpEghb9++VXvFihXStm1btc+dOyfFixdXu1WrVrJ69Wq1L126JIULF1Y7U6ZM8vjxY+N3p06dKgMGDNDxyZMny6BBg9Tet2+fVK9eXe0OHTrI0qVL1X7z5o2kTJlS7aFDh8qECROivNh/3N/f74DbwL/fO13pjR07VkaMGKHHsk6dOrJz5061CckLFy5I0aJFdfzZs2eSPn16tRctWiSdO3dWe9u2bVK/fn21kyRJIh8/fjSO/bJly6R9+/Y6zt8llJo0aSLR0dE6p127drJ8+XLDjXA+f/fEiRNStmxZnS8iEhUVZVyHz7hu3Tpp3ry58by8h4EDB8qUKVN0zpEjR6RixYpqN2rUSDZv3uwgbHkAQw7CljvovXjxQtKmTavHMk6cOPLz50+1CZMHDx5I1qxZdTwmJkYaN26sdp48eeTmzZtqN2vWTDZu3Kj2vXv3JHv27AaUyKrjx4+XYcOG6ZxZs2ZJ79691Y4XL558//5dbbqOSpUqyeHDh3WczE4IE2KDBw+WSZMm6fxXr15J6tSp1c6RI4fcvXtX7WzZssn9+/eN3yWz+2wbO3/06NEyatQone9HKe4E2p5Ay/Vhv9y7ceOG5M2b9zdm+fO4pkqVSl6/fq1zGKweO3ZMypcvr+PlypWT48ePq71r1y6pXbu22gyMCY02bdrIypUrdU6aNGnk5cuXavN+ihUrJufPn9dx/hYDY7oC2rwHuo4gls+VK5fcvn3bgDMjCroFP5h3ELbEkNtA2w1kjlmgQAG5evWqHmPmhmfOnJGSJUvqeK1atWT37t1qFylSRC5evKg2r0OmO3XqlJQuXVrnMNDdsmWLNGzYUMeZOz969EgyZ86s4w0aNJCtW7eqnSVLFnn48KHa3bp1k/nz5xs2mXrBggXStWtXI0Kgq6GLqFevnmzfvl3nlyhRQs6ePas2Iw0mF74rcyfQ9gRarg/75R7hwGPMIPbbt28SP358A26xKWcoFNJxBth79uyRmjVr6jilsOHDh8u4ceN0/M6dO5IzZ061a9SoIXv37jVgTnauUKGCHD161LgHQpvsnC5dOnn+/LnBqps2bZKmTZvqOANvPjtdFn+X7sjPtR2ELTHkNtB2A6nc8riOHDlSxowZo0ed7MOcl4Exg1WyOQNmQoYsOW3aNOnfv78BKwbwZGeyOSFJpZoBMBm/U6dOsnjxYv0tPu/EiRNlyJAhOk6Zjip9tWrVZP/+/TqnS5cusnDhQidnWR5AJ2dZbyCZ7tChQ1K5cmUj96SMwwLQmjVrpGXLlgZ7Um6iCk3IkKkJ4T59+sjMmTP1mixsUXaj2kz3QtcRxLBUuQl/3sO8efOke/fuRoLAfNx3I45ELI+g20DbDSRkGFQXKlRILl++rMeYOSPZjSxJ+YhBKRXjFi1ayNq1a/WarC+zcLNq1Spp3bq1EYRnyJBBnj59quO8B16TteZevXrJ7NmzjXyZuTyluSdPnkjGjBl1Pt0aow6u9eHvTqDtCbRcH/bLPeakfq0zdlcIbRaJ/ADyT1mJQSzZnAEzC1WsCxPCZF66kXfv3kny5MkVYleuXJGCBQuqTeZloEspjAxOCY7PQpfC52XQzr0qU6aMnDx50gXSthByPtByBz1CjyzM4g5zXrZ2EG6EDxVpriWTstZMiFEyYjDM2i4DdRZ6GNj/+PFD4saNayjMZF6yNpmX0QWDZ96bL+W5E2h7Ai3Xh/1yj9Bg0MsjzVoqYcKGQ+bIhDDVZuabhBIVYDIdC0CEKgs9LEgx4Cc781nItrwO75nPy2ZLn3ljT43rzvpH2HE+0HIjPQbMPK6ED4tBbJ9gUErllkUoriWLMVdl0yPzTQa0rNUGjTNCYJDMLiyupZzF56LsRpf169cv8TzPKdKWh+635Q7ClrvpkSUpDTEHZCGGgSWVW9pUjKk8MxcmY5J56UaoHhPadDtkT8KQ9WI2jnJ+UIGJ7qtUqVJy+vRphe2GDRskIiJCbT8pcCfQ9gRarg/75R6lJ0KYR5c5LDugWAtmPvt/bBW70wy8eU3Cn3Vkwjyo5st8lqxK1uYzUjlnEkHIJ0qUSD5//my0rHCOf88OwpYYchtou4HsaKIEROaiMsxglXBj8MnXFjiHwTPlLKrNVKfpFjifUCVrE7ZsBeF8tqxQjqO7IAuz5YMymr8P7gTankDL9WG/3OMxJjzZksGAk5CklETYMujlfMpEdBFkvSAlmffAPJdtJ3QRlMiCatx8K4pS3q1btyR37txG/ZoJgl8scxC2xJDbQNsNZEDLTieqr2RGQpvyFBVjqsF0C4QSA+AvX75IwoQJjQIQ2ZnzCU8WrXj/jApYI2YLB5MC2pTpyOaUxXz5zp1A2xNouT7sl3vsB2ZnFIs+zBk5h0oypSoWbsi8ZDpKQ8y7KUkFdUyRtRkkU4JjPs6AnK0mhH+CBAnk69ev6kZYF2YLCl2Q79YchC0x5DbQdgMZfLK2ywCYTYaUpAgH5o9UuRlUE568PlmVATZfeGRTJa9D5iWTssjFgJmBOtcyEWBEEdRG4neIuRNoewIt14f9co+BMV/QIwvzm1dkPQbMDHrJyIQSe6fZ5kEWZr7JCIG/S5bn7wZ98IfzmTjQNVGNp4LNKIINqL7LchC2xJDbQNsNZO2VwS1bMthsyZyUsg9bJggBshvZk1/JoJLMpkrmnrwm83S6GroLupGgHmlGEXQRzH/57JTv/Hq3O4G2J9Byfdgv95gPsnDDb0bxfVsGt0FtEnQFDM7ZksEAm+0i/FAPPxfAHmy6EcKWATzhX6VKFTl48KDmubxnugXm9cy1GWnQHfms7SBsiSG3gbYbSPjweLNjirVjsiRzWLIqWzWoWrMmS2Yk0/EemJMy1ybceB3mvIQn1xL+zIWpirPWzOtwH3yWdyfQ9gRarg/75R6Zlx1Q/JpHUJsHmyep4nKcBRoyIwN4SmqUpKh+010whyVs+c1nXpPuiC6F+TivT7dGVZzuy3214x9hx/lAy430KB+xlkollnVhvt3DIJZ5IjuaKDcRemRSvuRICFOeoh305hTdCKU5siebJHnPQa9y8HfZweXeF7Y8ef5yB2HLjfztNQcyEQNafuaOrMcglnVVvqmULFkyef/+veahlL/IjFSe+Xl2sjaLQQzaeU0GzGRYwpbdaHRNjBYYVFPmYouIKypZnjx/+X/o91v2U9IYogAAAABJRU5ErkJggg==);
}
@media only screen and (max-width: 600px) {
  :root {
    --size: 2;
  }
}
@media only screen and (max-width: 400px) {
  :root {
    --size: 1.4;
  }
}
.lightning {
  display: flex;
  position: relative;
  margin: 4vmin;
  filter: var(--svgfilter);
  span {
    color: black;
    letter-spacing: calc(var(--size) * 1vmin);
    font-size: 1rem;
    padding: calc(0.5 * 1rem) 0 0 0;
    margin-right: -1rem;
    text-align: left;
    text-shadow: none;
  }
  > * {
    margin: 0;
    flex-grow: 1;
    display: flex;
    justify-content: center;
    flex-direction: column;
    padding: calc(var(--size) * 0.8vmin) calc(var(--size) * 1.6vmin);

    transform: skew(calc(var(--skew) * -1deg), calc(var(--skew) * -1deg));
    font-size: calc(var(--size) * 3vmax);
    font-weight: 700;
    color: Crimson;

    text-transform: uppercase;
    text-align: right;
    border: 3px solid var(--boxshadow);
    border-left: 0;
    text-shadow: var(--textshadow) 0px 0px 0px,
      var(--textshadow) 0.669131px 0.743145px 0px,
      var(--textshadow) 1.33826px 1.48629px 0px,
      var(--textshadow) 2.00739px 2.22943px 0px,
      var(--textshadow) 2.67652px 2.97258px 0px,
      var(--textshadow) 3.34565px 3.71572px 0px,
      var(--textshadow) 4.01478px 4.45887px 0px,
      var(--textshadow) 4.68391px 5.20201px 0px;
    box-shadow: var(--border) 0px 0px 0px,
      var(--boxshadow) 0.819152px 0.573576px 0px,
      var(--boxshadow) 1.6383px 1.14715px 0px,
      var(--boxshadow) 2.45746px 1.72073px 0px,
      var(--boxshadow) 3.27661px 2.29431px 0px,
      var(--boxshadow) 4.09576px 2.86788px 0px,
      var(--boxshadow) 4.91491px 3.44146px 0px,
      var(--boxshadow) 5.73406px 4.01504px 0px,
      var(--boxshadow) 6.55322px 4.58861px 0px,
      var(--boxshadow) 7.37237px 5.16219px 0px,
      var(--boxshadow) 8.19152px 5.73576px 0px,
      var(--boxshadow) 9.01067px 6.30934px 0px,
      var(--boxshadow) 9.82982px 6.88292px 0px,
      var(--boxshadow) 10.649px 7.45649px 0px,
      var(--boxshadow) 11.4681px 8.03007px 0px;
    &:last-child {
      left: calc(var(--size) * -1vmin);
      position: relative;
      text-align: left;
       font-size: 8vmin;
      span {
        border-top: 1px solid;
      }
    }
  }
}



.noisy {
  background-image: var(--noise-image);
}


svg {
  height: 1px;
}





#line-one {
  text-shadow: rgb(70, 139, 151) 0px 0px, rgb(70, 139, 151) -1px 1px, rgb(70, 139, 151) -2px 2px, rgb(70, 139, 151) -3px 3px, rgb(70, 139, 151) -4px 4px, rgb(70, 139, 151) -5px 5px, rgb(70, 139, 151) -6px 6px, rgb(70, 139, 151) -7px 7px, rgb(70, 139, 151) -8px 8px, rgb(70, 139, 151) -9px 9px, rgb(70, 139, 151) -10px 10px, rgb(70, 139, 151) -11px 11px, rgb(70, 139, 151) -12px 12px, rgb(70, 139, 151) -13px 13px, rgb(70, 139, 151) -14px 14px, rgb(70, 139, 151) -15px 15px, rgb(70, 139, 151) -16px 16px, rgb(70, 139, 151) -17px 17px, rgb(70, 139, 151) -18px 18px, rgb(70, 139, 151) -19px 19px, rgb(70, 139, 151) -20px 20px, rgb(70, 139, 151) -21px 21px, rgb(70, 139, 151) -22px 22px, rgb(70, 139, 151) -23px 23px, rgb(70, 139, 151) -24px 24px, rgb(70, 139, 151) -25px 25px, rgb(70, 139, 151) -26px 26px, rgb(70, 139, 151) -27px 27px, rgb(70, 139, 151) -28px 28px, rgb(70, 139, 151) -29px 29px, rgb(70, 139, 151) -30px 30px, rgb(70, 139, 151) -31px 31px, rgb(70, 139, 151) -32px 32px, rgb(70, 139, 151) -33px 33px, rgb(70, 139, 151) -34px 34px, rgb(70, 139, 151) -35px 35px, rgb(70, 139, 151) -36px 36px, rgb(70, 139, 151) -37px 37px, rgb(70, 139, 151) -38px 38px, rgb(70, 139, 151) -39px 39px, rgb(70, 139, 151) -40px 40px, rgb(70, 139, 151) -41px 41px, rgb(70, 139, 151) -42px 42px, rgb(70, 139, 151) -43px 43px, rgb(70, 139, 151) -44px 44px, rgb(70, 139, 151) -45px 45px, rgb(70, 139, 151) -46px 46px, rgb(70, 139, 151) -47px 47px, rgb(70, 139, 151) -48px 48px, rgb(70, 139, 151) -49px 49px, rgb(70, 139, 151) -50px 50px, rgb(70, 139, 151) -51px 51px, rgb(70, 139, 151) -52px 52px, rgb(70, 139, 151) -53px 53px, rgb(70, 139, 151) -54px 54px, rgb(70, 139, 151) -55px 55px, rgb(70, 139, 151) -56px 56px, rgb(70, 139, 151) -57px 57px, rgb(70, 139, 151) -58px 58px, rgb(70, 139, 151) -59px 59px, rgb(70, 139, 151) -60px 60px, rgb(70, 139, 151) -61px 61px, rgb(70, 139, 151) -62px 62px, rgb(70, 139, 151) -63px 63px, rgb(70, 139, 151) -64px 64px, rgb(70, 139, 151) -65px 65px, rgb(70, 139, 151) -66px 66px, rgb(70, 139, 151) -67px 67px, rgb(70, 139, 151) -68px 68px, rgb(70, 139, 151) -69px 69px, rgb(70, 139, 151) -70px 70px, rgb(70, 139, 151) -71px 71px, rgb(70, 139, 151) -72px 72px, rgb(70, 139, 151) -73px 73px, rgb(70, 139, 151) -74px 74px, rgb(70, 139, 151) -75px 75px, rgb(70, 139, 151) -76px 76px, rgb(70, 139, 151) -77px 77px, rgb(70, 139, 151) -78px 78px, rgb(70, 139, 151) -79px 79px, rgb(70, 139, 151) -80px 80px, rgb(70, 139, 151) -81px 81px, rgb(70, 139, 151) -82px 82px, rgb(70, 139, 151) -83px 83px, rgb(70, 139, 151) -84px 84px, rgb(70, 139, 151) -85px 85px, rgb(70, 139, 151) -86px 86px, rgb(70, 139, 151) -87px 87px, rgb(70, 139, 151) -88px 88px, rgb(70, 139, 151) -89px 89px, rgb(70, 139, 151) -90px 90px, rgb(70, 139, 151) -91px 91px, rgb(70, 139, 151) -92px 92px, rgb(70, 139, 151) -93px 93px, rgb(70, 139, 151) -94px 94px, rgb(70, 139, 151) -95px 95px, rgb(70, 139, 151) -96px 96px, rgb(70, 139, 151) -97px 97px, rgb(70, 139, 151) -98px 98px, rgb(70, 139, 151) -99px 99px, rgb(70, 139, 151) -100px 100px, rgb(70, 139, 151) -101px 101px, rgb(70, 139, 151) -102px 102px, rgb(70, 139, 151) -103px 103px, rgb(70, 139, 151) -104px 104px, rgb(70, 139, 151) -105px 105px, rgb(70, 139, 151) -106px 106px, rgb(70, 139, 151) -107px 107px, rgb(70, 139, 151) -108px 108px, rgb(70, 139, 151) -109px 109px, rgb(70, 139, 151) -110px 110px, rgb(70, 139, 151) -111px 111px, rgb(70, 139, 151) -112px 112px, rgb(70, 139, 151) -113px 113px, rgb(70, 139, 151) -114px 114px, rgb(70, 139, 151) -115px 115px, rgb(70, 139, 151) -116px 116px, rgb(70, 139, 151) -117px 117px, rgb(70, 139, 151) -118px 118px, rgb(70, 139, 151) -119px 119px, rgb(70, 139, 151) -120px 120px, rgb(70, 139, 151) -121px 121px, rgb(70, 139, 151) -122px 122px, rgb(70, 139, 151) -123px 123px, rgb(70, 139, 151) -124px 124px, rgb(70, 139, 151) -125px 125px, rgb(70, 139, 151) -126px 126px, rgb(70, 139, 151) -127px 127px, rgb(70, 139, 151) -128px 128px, rgb(70, 139, 151) -129px 129px, rgb(70, 139, 151) -130px 130px, rgb(70, 139, 151) -131px 131px, rgb(70, 139, 151) -132px 132px, rgb(70, 139, 151) -133px 133px, rgb(70, 139, 151) -134px 134px, rgb(70, 139, 151) -135px 135px, rgb(70, 139, 151) -136px 136px, rgb(70, 139, 151) -137px 137px, rgb(70, 139, 151) -138px 138px, rgb(70, 139, 151) -139px 139px, rgb(70, 139, 151) -140px 140px, rgb(70, 139, 151) -141px 141px, rgb(70, 139, 151) -142px 142px, rgb(70, 139, 151) -143px 143px, rgb(70, 139, 151) -144px 144px, rgb(70, 139, 151) -145px 145px, rgb(70, 139, 151) -146px 146px, rgb(70, 139, 151) -147px 147px, rgb(70, 139, 151) -148px 148px, rgb(70, 139, 151) -149px 149px, rgb(70, 139, 151) -150px 150px, rgb(70, 139, 151) -151px 151px, rgb(70, 139, 151) -152px 152px, rgb(70, 139, 151) -153px 153px, rgb(70, 139, 151) -154px 154px, rgb(70, 139, 151) -155px 155px, rgb(70, 139, 151) -156px 156px, rgb(70, 139, 151) -157px 157px, rgb(70, 139, 151) -158px 158px, rgb(70, 139, 151) -159px 159px, rgb(70, 139, 151) -160px 160px, rgb(70, 139, 151) -161px 161px, rgb(70, 139, 151) -162px 162px, rgb(70, 139, 151) -163px 163px, rgb(70, 139, 151) -164px 164px, rgb(70, 139, 151) -165px 165px, rgb(70, 139, 151) -166px 166px, rgb(70, 139, 151) -167px 167px, rgb(70, 139, 151) -168px 168px, rgb(70, 139, 151) -169px 169px, rgb(70, 139, 151) -170px 170px, rgb(70, 139, 151) -171px 171px, rgb(70, 139, 151) -172px 172px, rgb(70, 139, 151) -173px 173px, rgb(70, 139, 151) -174px 174px, rgb(70, 139, 151) -175px 175px, rgb(70, 139, 151) -176px 176px, rgb(70, 139, 151) -177px 177px, rgb(70, 139, 151) -178px 178px, rgb(70, 139, 151) -179px 179px, rgb(70, 139, 151) -180px 180px, rgb(70, 139, 151) -181px 181px, rgb(70, 139, 151) -182px 182px, rgb(70, 139, 151) -183px 183px, rgb(70, 139, 151) -184px 184px, rgb(70, 139, 151) -185px 185px, rgb(70, 139, 151) -186px 186px, rgb(70, 139, 151) -187px 187px, rgb(70, 139, 151) -188px 188px, rgb(70, 139, 151) -189px 189px, rgb(70, 139, 151) -190px 190px, rgb(70, 139, 151) -191px 191px, rgb(70, 139, 151) -192px 192px, rgb(70, 139, 151) -193px 193px, rgb(70, 139, 151) -194px 194px, rgb(70, 139, 151) -195px 195px, rgb(70, 139, 151) -196px 196px, rgb(70, 139, 151) -197px 197px, rgb(70, 139, 151) -198px 198px, rgb(70, 139, 151) -199px 199px, rgb(70, 139, 151) -200px 200px, rgb(70, 139, 151) -201px 201px, rgb(70, 139, 151) -202px 202px, rgb(70, 139, 151) -203px 203px, rgb(70, 139, 151) -204px 204px, rgb(70, 139, 151) -205px 205px, rgb(70, 139, 151) -206px 206px, rgb(70, 139, 151) -207px 207px, rgb(70, 139, 151) -208px 208px, rgb(70, 139, 151) -209px 209px, rgb(70, 139, 151) -210px 210px, rgb(70, 139, 151) -211px 211px, rgb(70, 139, 151) -212px 212px, rgb(70, 139, 151) -213px 213px, rgb(70, 139, 151) -214px 214px, rgb(70, 139, 151) -215px 215px, rgb(70, 139, 151) -216px 216px, rgb(70, 139, 151) -217px 217px, rgb(70, 139, 151) -218px 218px, rgb(70, 139, 151) -219px 219px, rgb(70, 139, 151) -220px 220px, rgb(70, 139, 151) -221px 221px, rgb(70, 139, 151) -222px 222px, rgb(70, 139, 151) -223px 223px, rgb(70, 139, 151) -224px 224px, rgb(70, 139, 151) -225px 225px, rgb(70, 139, 151) -226px 226px, rgb(70, 139, 151) -227px 227px, rgb(70, 139, 151) -228px 228px, rgb(70, 139, 151) -229px 229px, rgb(70, 139, 151) -230px 230px, rgb(70, 139, 151) -231px 231px, rgb(70, 139, 151) -232px 232px, rgb(70, 139, 151) -233px 233px, rgb(70, 139, 151) -234px 234px, rgb(70, 139, 151) -235px 235px, rgb(70, 139, 151) -236px 236px, rgb(70, 139, 151) -237px 237px, rgb(70, 139, 151) -238px 238px, rgb(70, 139, 151) -239px 239px, rgb(70, 139, 151) -240px 240px, rgb(70, 139, 151) -241px 241px, rgb(70, 139, 151) -242px 242px, rgb(70, 139, 151) -243px 243px, rgb(70, 139, 151) -244px 244px, rgb(70, 139, 151) -245px 245px, rgb(70, 139, 151) -246px 246px, rgb(70, 139, 151) -247px 247px, rgb(70, 139, 151) -248px 248px, rgb(70, 139, 151) -249px 249px, rgb(70, 139, 151) -250px 250px, rgb(70, 139, 151) -251px 251px, rgb(70, 139, 151) -252px 252px, rgb(70, 139, 151) -253px 253px, rgb(70, 139, 151) -254px 254px, rgb(70, 139, 151) -255px 255px, rgb(70, 139, 151) -256px 256px, rgb(70, 139, 151) -257px 257px, rgb(70, 139, 151) -258px 258px, rgb(70, 139, 151) -259px 259px, rgb(70, 139, 151) -260px 260px, rgb(70, 139, 151) -261px 261px, rgb(70, 139, 151) -262px 262px, rgb(70, 139, 151) -263px 263px, rgb(70, 139, 151) -264px 264px, rgb(70, 139, 151) -265px 265px, rgb(70, 139, 151) -266px 266px, rgb(70, 139, 151) -267px 267px, rgb(70, 139, 151) -268px 268px, rgb(70, 139, 151) -269px 269px, rgb(70, 139, 151) -270px 270px, rgb(70, 139, 151) -271px 271px, rgb(70, 139, 151) -272px 272px, rgb(70, 139, 151) -273px 273px, rgb(70, 139, 151) -274px 274px, rgb(70, 139, 151) -275px 275px, rgb(70, 139, 151) -276px 276px, rgb(70, 139, 151) -277px 277px, rgb(70, 139, 151) -278px 278px, rgb(70, 139, 151) -279px 279px, rgb(70, 139, 151) -280px 280px, rgb(70, 139, 151) -281px 281px, rgb(70, 139, 151) -282px 282px, rgb(70, 139, 151) -283px 283px, rgb(70, 139, 151) -284px 284px, rgb(70, 139, 151) -285px 285px, rgb(70, 139, 151) -286px 286px, rgb(70, 139, 151) -287px 287px, rgb(70, 139, 151) -288px 288px, rgb(70, 139, 151) -289px 289px, rgb(70, 139, 151) -290px 290px, rgb(70, 139, 151) -291px 291px, rgb(70, 139, 151) -292px 292px, rgb(70, 139, 151) -293px 293px, rgb(70, 139, 151) -294px 294px, rgb(70, 139, 151) -295px 295px, rgb(70, 139, 151) -296px 296px, rgb(70, 139, 151) -297px 297px, rgb(70, 139, 151) -298px 298px, rgb(70, 139, 151) -299px 299px, rgb(70, 139, 151) -300px 300px, rgb(70, 139, 151) -301px 301px, rgb(70, 139, 151) -302px 302px, rgb(70, 139, 151) -303px 303px, rgb(70, 139, 151) -304px 304px, rgb(70, 139, 151) -305px 305px, rgb(70, 139, 151) -306px 306px, rgb(70, 139, 151) -307px 307px, rgb(70, 139, 151) -308px 308px, rgb(70, 139, 151) -309px 309px, rgb(70, 139, 151) -310px 310px, rgb(70, 139, 151) -311px 311px, rgb(70, 139, 151) -312px 312px, rgb(70, 139, 151) -313px 313px, rgb(70, 139, 151) -314px 314px, rgb(70, 139, 151) -315px 315px, rgb(70, 139, 151) -316px 316px, rgb(70, 139, 151) -317px 317px, rgb(70, 139, 151) -318px 318px, rgb(70, 139, 151) -319px 319px, rgb(70, 139, 151) -320px 320px, rgb(70, 139, 151) -321px 321px, rgb(70, 139, 151) -322px 322px, rgb(70, 139, 151) -323px 323px, rgb(70, 139, 151) -324px 324px, rgb(70, 139, 151) -325px 325px, rgb(70, 139, 151) -326px 326px, rgb(70, 139, 151) -327px 327px, rgb(70, 139, 151) -328px 328px, rgb(70, 139, 151) -329px 329px, rgb(70, 139, 151) -330px 330px, rgb(70, 139, 151) -331px 331px, rgb(70, 139, 151) -332px 332px, rgb(70, 139, 151) -333px 333px, rgb(70, 139, 151) -334px 334px, rgb(70, 139, 151) -335px 335px, rgb(70, 139, 151) -336px 336px, rgb(70, 139, 151) -337px 337px, rgb(70, 139, 151) -338px 338px, rgb(70, 139, 151) -339px 339px, rgb(70, 139, 151) -340px 340px, rgb(70, 139, 151) -341px 341px, rgb(70, 139, 151) -342px 342px, rgb(70, 139, 151) -343px 343px, rgb(70, 139, 151) -344px 344px, rgb(70, 139, 151) -345px 345px, rgb(70, 139, 151) -346px 346px, rgb(70, 139, 151) -347px 347px, rgb(70, 139, 151) -348px 348px, rgb(70, 139, 151) -349px 349px, rgb(70, 139, 151) -350px 350px, rgb(70, 139, 151) -351px 351px, rgb(70, 139, 151) -352px 352px, rgb(70, 139, 151) -353px 353px, rgb(70, 139, 151) -354px 354px, rgb(70, 139, 151) -355px 355px, rgb(70, 139, 151) -356px 356px, rgb(70, 139, 151) -357px 357px, rgb(70, 139, 151) -358px 358px, rgb(70, 139, 151) -359px 359px, rgb(70, 139, 151) -360px 360px, rgb(70, 139, 151) -361px 361px, rgb(70, 139, 151) -362px 362px, rgb(70, 139, 151) -363px 363px, rgb(70, 139, 151) -364px 364px, rgb(70, 139, 151) -365px 365px, rgb(70, 139, 151) -366px 366px, rgb(70, 139, 151) -367px 367px, rgb(70, 139, 151) -368px 368px, rgb(70, 139, 151) -369px 369px, rgb(70, 139, 151) -370px 370px, rgb(70, 139, 151) -371px 371px, rgb(70, 139, 151) -372px 372px, rgb(70, 139, 151) -373px 373px, rgb(70, 139, 151) -374px 374px, rgb(70, 139, 151) -375px 375px, rgb(70, 139, 151) -376px 376px, rgb(70, 139, 151) -377px 377px, rgb(70, 139, 151) -378px 378px, rgb(70, 139, 151) -379px 379px, rgb(70, 139, 151) -380px 380px, rgb(70, 139, 151) -381px 381px, rgb(70, 139, 151) -382px 382px, rgb(70, 139, 151) -383px 383px, rgb(70, 139, 151) -384px 384px, rgb(70, 139, 151) -385px 385px, rgb(70, 139, 151) -386px 386px, rgb(70, 139, 151) -387px 387px, rgb(70, 139, 151) -388px 388px, rgb(70, 139, 151) -389px 389px, rgb(70, 139, 151) -390px 390px, rgb(70, 139, 151) -391px 391px, rgb(70, 139, 151) -392px 392px, rgb(70, 139, 151) -393px 393px, rgb(70, 139, 151) -394px 394px, rgb(70, 139, 151) -395px 395px, rgb(70, 139, 151) -396px 396px, rgb(70, 139, 151) -397px 397px, rgb(70, 139, 151) -398px 398px, rgb(70, 139, 151) -399px 399px, rgb(70, 139, 151) -400px 400px, rgb(70, 139, 151) -401px 401px, rgb(70, 139, 151) -402px 402px, rgb(70, 139, 151) -403px 403px, rgb(70, 139, 151) -404px 404px, rgb(70, 139, 151) -405px 405px, rgb(70, 139, 151) -406px 406px, rgb(70, 139, 151) -407px 407px, rgb(70, 139, 151) -408px 408px, rgb(70, 139, 151) -409px 409px, rgb(70, 139, 151) -410px 410px, rgb(70, 139, 151) -411px 411px, rgb(70, 139, 151) -412px 412px, rgb(70, 139, 151) -413px 413px, rgb(70, 139, 151) -414px 414px, rgb(70, 139, 151) -415px 415px, rgb(70, 139, 151) -416px 416px, rgb(70, 139, 151) -417px 417px, rgb(70, 139, 151) -418px 418px, rgb(70, 139, 151) -419px 419px, rgb(70, 139, 151) -420px 420px, rgb(70, 139, 151) -421px 421px, rgb(70, 139, 151) -422px 422px, rgb(70, 139, 151) -423px 423px, rgb(70, 139, 151) -424px 424px, rgb(70, 139, 151) -425px 425px, rgb(70, 139, 151) -426px 426px, rgb(70, 139, 151) -427px 427px, rgb(70, 139, 151) -428px 428px, rgb(70, 139, 151) -429px 429px, rgb(70, 139, 151) -430px 430px, rgb(70, 139, 151) -431px 431px, rgb(70, 139, 151) -432px 432px, rgb(70, 139, 151) -433px 433px, rgb(70, 139, 151) -434px 434px, rgb(70, 139, 151) -435px 435px, rgb(70, 139, 151) -436px 436px, rgb(70, 139, 151) -437px 437px, rgb(70, 139, 151) -438px 438px, rgb(70, 139, 151) -439px 439px, rgb(70, 139, 151) -440px 440px, rgb(70, 139, 151) -441px 441px, rgb(70, 139, 151) -442px 442px, rgb(70, 139, 151) -443px 443px, rgb(70, 139, 151) -444px 444px, rgb(70, 139, 151) -445px 445px, rgb(70, 139, 151) -446px 446px, rgb(70, 139, 151) -447px 447px, rgb(70, 139, 151) -448px 448px, rgb(70, 139, 151) -449px 449px, rgb(70, 139, 151) -450px 450px, rgb(70, 139, 151) -451px 451px, rgb(70, 139, 151) -452px 452px, rgb(70, 139, 151) -453px 453px, rgb(70, 139, 151) -454px 454px, rgb(70, 139, 151) -455px 455px, rgb(70, 139, 151) -456px 456px, rgb(70, 139, 151) -457px 457px, rgb(70, 139, 151) -458px 458px, rgb(70, 139, 151) -459px 459px, rgb(70, 139, 151) -460px 460px, rgb(70, 139, 151) -461px 461px, rgb(70, 139, 151) -462px 462px, rgb(70, 139, 151) -463px 463px, rgb(70, 139, 151) -464px 464px, rgb(70, 139, 151) -465px 465px, rgb(70, 139, 151) -466px 466px, rgb(70, 139, 151) -467px 467px, rgb(70, 139, 151) -468px 468px, rgb(70, 139, 151) -469px 469px, rgb(70, 139, 151) -470px 470px, rgb(70, 139, 151) -471px 471px, rgb(70, 139, 151) -472px 472px, rgb(70, 139, 151) -473px 473px, rgb(70, 139, 151) -474px 474px, rgb(70, 139, 151) -475px 475px, rgb(70, 139, 151) -476px 476px, rgb(70, 139, 151) -477px 477px, rgb(70, 139, 151) -478px 478px, rgb(70, 139, 151) -479px 479px, rgb(70, 139, 151) -480px 480px, rgb(70, 139, 151) -481px 481px, rgb(70, 139, 151) -482px 482px, rgb(70, 139, 151) -483px 483px, rgb(70, 139, 151) -484px 484px, rgb(70, 139, 151) -485px 485px, rgb(70, 139, 151) -486px 486px, rgb(70, 139, 151) -487px 487px, rgb(70, 139, 151) -488px 488px, rgb(70, 139, 151) -489px 489px, rgb(70, 139, 151) -490px 490px, rgb(70, 139, 151) -491px 491px, rgb(70, 139, 151) -492px 492px, rgb(70, 139, 151) -493px 493px, rgb(70, 139, 151) -494px 494px, rgb(70, 139, 151) -495px 495px, rgb(70, 139, 151) -496px 496px, rgb(70, 139, 151) -497px 497px, rgb(70, 139, 151) -498px 498px, rgb(70, 139, 151) -499px 499px, rgba(0, 0, 0, 0.4) -10px 0px 15px, rgba(0, 0, 0, 0.4) -20px 10px 15px, rgba(0, 0, 0, 0.4) -30px 20px 15px, rgba(0, 0, 0, 0.4) -40px 30px 15px, rgba(0, 0, 0, 0.4) -50px 40px 15px, rgba(0, 0, 0, 0.4) -60px 50px 15px, rgba(0, 0, 0, 0.4) -70px 60px 15px, rgba(0, 0, 0, 0.4) -80px 70px 15px, rgba(0, 0, 0, 0.4) -90px 80px 15px, rgba(0, 0, 0, 0.4) -100px 90px 15px, rgba(0, 0, 0, 0.4) -110px 100px 15px, rgba(0, 0, 0, 0.4) -120px 110px 15px, rgba(0, 0, 0, 0.4) -130px 120px 15px, rgba(0, 0, 0, 0.4) -140px 130px 15px, rgba(0, 0, 0, 0.4) -150px 140px 15px, rgba(0, 0, 0, 0.4) -160px 150px 15px, rgba(0, 0, 0, 0.4) -170px 160px 15px, rgba(0, 0, 0, 0.4) -180px 170px 15px, rgba(0, 0, 0, 0.4) -190px 180px 15px, rgba(0, 0, 0, 0.4) -200px 190px 15px, rgba(0, 0, 0, 0.4) -210px 200px 15px, rgba(0, 0, 0, 0.4) -220px 210px 15px, rgba(0, 0, 0, 0.4) -230px 220px 15px, rgba(0, 0, 0, 0.4) -240px 230px 15px, rgba(0, 0, 0, 0.4) -250px 240px 15px, rgba(0, 0, 0, 0.4) -260px 250px 15px, rgba(0, 0, 0, 0.4) -270px 260px 15px, rgba(0, 0, 0, 0.4) -280px 270px 15px, rgba(0, 0, 0, 0.4) -290px 280px 15px, rgba(0, 0, 0, 0.4) -300px 290px 15px, rgba(0, 0, 0, 0.4) -310px 300px 15px, rgba(0, 0, 0, 0.4) -320px 310px 15px, rgba(0, 0, 0, 0.4) -330px 320px 15px, rgba(0, 0, 0, 0.4) -340px 330px 15px, rgba(0, 0, 0, 0.4) -350px 340px 15px, rgba(0, 0, 0, 0.4) -360px 350px 15px, rgba(0, 0, 0, 0.4) -370px 360px 15px, rgba(0, 0, 0, 0.4) -380px 370px 15px, rgba(0, 0, 0, 0.4) -390px 380px 15px, rgba(0, 0, 0, 0.4) -400px 390px 15px, rgba(0, 0, 0, 0.4) -410px 400px 15px, rgba(0, 0, 0, 0.4) -420px 410px 15px, rgba(0, 0, 0, 0.4) -430px 420px 15px, rgba(0, 0, 0, 0.4) -440px 430px 15px, rgba(0, 0, 0, 0.4) -450px 440px 15px, rgba(0, 0, 0, 0.4) -460px 450px 15px, rgba(0, 0, 0, 0.4) -470px 460px 15px, rgba(0, 0, 0, 0.4) -480px 470px 15px, rgba(0, 0, 0, 0.4) -490px 480px 15px, rgba(0, 0, 0, 0.4) -500px 490px 15px
}
#line-three {
  text-shadow: rgb(243, 170, 96) 0px 0px, rgb(243, 170, 96) -1px 1px, rgb(243, 170, 96) -2px 2px, rgb(243, 170, 96) -3px 3px, rgb(243, 170, 96) -4px 4px, rgb(243, 170, 96) -5px 5px, rgb(243, 170, 96) -6px 6px, rgb(243, 170, 96) -7px 7px, rgb(243, 170, 96) -8px 8px, rgb(243, 170, 96) -9px 9px, rgb(243, 170, 96) -10px 10px, rgb(243, 170, 96) -11px 11px, rgb(243, 170, 96) -12px 12px, rgb(243, 170, 96) -13px 13px, rgb(243, 170, 96) -14px 14px, rgb(243, 170, 96) -15px 15px, rgb(243, 170, 96) -16px 16px, rgb(243, 170, 96) -17px 17px, rgb(243, 170, 96) -18px 18px, rgb(243, 170, 96) -19px 19px, rgb(243, 170, 96) -20px 20px, rgb(243, 170, 96) -21px 21px, rgb(243, 170, 96) -22px 22px, rgb(243, 170, 96) -23px 23px, rgb(243, 170, 96) -24px 24px, rgb(243, 170, 96) -25px 25px, rgb(243, 170, 96) -26px 26px, rgb(243, 170, 96) -27px 27px, rgb(243, 170, 96) -28px 28px, rgb(243, 170, 96) -29px 29px, rgb(243, 170, 96) -30px 30px, rgb(243, 170, 96) -31px 31px, rgb(243, 170, 96) -32px 32px, rgb(243, 170, 96) -33px 33px, rgb(243, 170, 96) -34px 34px, rgb(243, 170, 96) -35px 35px, rgb(243, 170, 96) -36px 36px, rgb(243, 170, 96) -37px 37px, rgb(243, 170, 96) -38px 38px, rgb(243, 170, 96) -39px 39px, rgb(243, 170, 96) -40px 40px, rgb(243, 170, 96) -41px 41px, rgb(243, 170, 96) -42px 42px, rgb(243, 170, 96) -43px 43px, rgb(243, 170, 96) -44px 44px, rgb(243, 170, 96) -45px 45px, rgb(243, 170, 96) -46px 46px, rgb(243, 170, 96) -47px 47px, rgb(243, 170, 96) -48px 48px, rgb(243, 170, 96) -49px 49px, rgb(243, 170, 96) -50px 50px, rgb(243, 170, 96) -51px 51px, rgb(243, 170, 96) -52px 52px, rgb(243, 170, 96) -53px 53px, rgb(243, 170, 96) -54px 54px, rgb(243, 170, 96) -55px 55px, rgb(243, 170, 96) -56px 56px, rgb(243, 170, 96) -57px 57px, rgb(243, 170, 96) -58px 58px, rgb(243, 170, 96) -59px 59px, rgb(243, 170, 96) -60px 60px, rgb(243, 170, 96) -61px 61px, rgb(243, 170, 96) -62px 62px, rgb(243, 170, 96) -63px 63px, rgb(243, 170, 96) -64px 64px, rgb(243, 170, 96) -65px 65px, rgb(243, 170, 96) -66px 66px, rgb(243, 170, 96) -67px 67px, rgb(243, 170, 96) -68px 68px, rgb(243, 170, 96) -69px 69px, rgb(243, 170, 96) -70px 70px, rgb(243, 170, 96) -71px 71px, rgb(243, 170, 96) -72px 72px, rgb(243, 170, 96) -73px 73px, rgb(243, 170, 96) -74px 74px, rgb(243, 170, 96) -75px 75px, rgb(243, 170, 96) -76px 76px, rgb(243, 170, 96) -77px 77px, rgb(243, 170, 96) -78px 78px, rgb(243, 170, 96) -79px 79px, rgb(243, 170, 96) -80px 80px, rgb(243, 170, 96) -81px 81px, rgb(243, 170, 96) -82px 82px, rgb(243, 170, 96) -83px 83px, rgb(243, 170, 96) -84px 84px, rgb(243, 170, 96) -85px 85px, rgb(243, 170, 96) -86px 86px, rgb(243, 170, 96) -87px 87px, rgb(243, 170, 96) -88px 88px, rgb(243, 170, 96) -89px 89px, rgb(243, 170, 96) -90px 90px, rgb(243, 170, 96) -91px 91px, rgb(243, 170, 96) -92px 92px, rgb(243, 170, 96) -93px 93px, rgb(243, 170, 96) -94px 94px, rgb(243, 170, 96) -95px 95px, rgb(243, 170, 96) -96px 96px, rgb(243, 170, 96) -97px 97px, rgb(243, 170, 96) -98px 98px, rgb(243, 170, 96) -99px 99px, rgb(243, 170, 96) -100px 100px, rgb(243, 170, 96) -101px 101px, rgb(243, 170, 96) -102px 102px, rgb(243, 170, 96) -103px 103px, rgb(243, 170, 96) -104px 104px, rgb(243, 170, 96) -105px 105px, rgb(243, 170, 96) -106px 106px, rgb(243, 170, 96) -107px 107px, rgb(243, 170, 96) -108px 108px, rgb(243, 170, 96) -109px 109px, rgb(243, 170, 96) -110px 110px, rgb(243, 170, 96) -111px 111px, rgb(243, 170, 96) -112px 112px, rgb(243, 170, 96) -113px 113px, rgb(243, 170, 96) -114px 114px, rgb(243, 170, 96) -115px 115px, rgb(243, 170, 96) -116px 116px, rgb(243, 170, 96) -117px 117px, rgb(243, 170, 96) -118px 118px, rgb(243, 170, 96) -119px 119px, rgb(243, 170, 96) -120px 120px, rgb(243, 170, 96) -121px 121px, rgb(243, 170, 96) -122px 122px, rgb(243, 170, 96) -123px 123px, rgb(243, 170, 96) -124px 124px, rgb(243, 170, 96) -125px 125px, rgb(243, 170, 96) -126px 126px, rgb(243, 170, 96) -127px 127px, rgb(243, 170, 96) -128px 128px, rgb(243, 170, 96) -129px 129px, rgb(243, 170, 96) -130px 130px, rgb(243, 170, 96) -131px 131px, rgb(243, 170, 96) -132px 132px, rgb(243, 170, 96) -133px 133px, rgb(243, 170, 96) -134px 134px, rgb(243, 170, 96) -135px 135px, rgb(243, 170, 96) -136px 136px, rgb(243, 170, 96) -137px 137px, rgb(243, 170, 96) -138px 138px, rgb(243, 170, 96) -139px 139px, rgb(243, 170, 96) -140px 140px, rgb(243, 170, 96) -141px 141px, rgb(243, 170, 96) -142px 142px, rgb(243, 170, 96) -143px 143px, rgb(243, 170, 96) -144px 144px, rgb(243, 170, 96) -145px 145px, rgb(243, 170, 96) -146px 146px, rgb(243, 170, 96) -147px 147px, rgb(243, 170, 96) -148px 148px, rgb(243, 170, 96) -149px 149px, rgb(243, 170, 96) -150px 150px, rgb(243, 170, 96) -151px 151px, rgb(243, 170, 96) -152px 152px, rgb(243, 170, 96) -153px 153px, rgb(243, 170, 96) -154px 154px, rgb(243, 170, 96) -155px 155px, rgb(243, 170, 96) -156px 156px, rgb(243, 170, 96) -157px 157px, rgb(243, 170, 96) -158px 158px, rgb(243, 170, 96) -159px 159px, rgb(243, 170, 96) -160px 160px, rgb(243, 170, 96) -161px 161px, rgb(243, 170, 96) -162px 162px, rgb(243, 170, 96) -163px 163px, rgb(243, 170, 96) -164px 164px, rgb(243, 170, 96) -165px 165px, rgb(243, 170, 96) -166px 166px, rgb(243, 170, 96) -167px 167px, rgb(243, 170, 96) -168px 168px, rgb(243, 170, 96) -169px 169px, rgb(243, 170, 96) -170px 170px, rgb(243, 170, 96) -171px 171px, rgb(243, 170, 96) -172px 172px, rgb(243, 170, 96) -173px 173px, rgb(243, 170, 96) -174px 174px, rgb(243, 170, 96) -175px 175px, rgb(243, 170, 96) -176px 176px, rgb(243, 170, 96) -177px 177px, rgb(243, 170, 96) -178px 178px, rgb(243, 170, 96) -179px 179px, rgb(243, 170, 96) -180px 180px, rgb(243, 170, 96) -181px 181px, rgb(243, 170, 96) -182px 182px, rgb(243, 170, 96) -183px 183px, rgb(243, 170, 96) -184px 184px, rgb(243, 170, 96) -185px 185px, rgb(243, 170, 96) -186px 186px, rgb(243, 170, 96) -187px 187px, rgb(243, 170, 96) -188px 188px, rgb(243, 170, 96) -189px 189px, rgb(243, 170, 96) -190px 190px, rgb(243, 170, 96) -191px 191px, rgb(243, 170, 96) -192px 192px, rgb(243, 170, 96) -193px 193px, rgb(243, 170, 96) -194px 194px, rgb(243, 170, 96) -195px 195px, rgb(243, 170, 96) -196px 196px, rgb(243, 170, 96) -197px 197px, rgb(243, 170, 96) -198px 198px, rgb(243, 170, 96) -199px 199px, rgb(243, 170, 96) -200px 200px, rgb(243, 170, 96) -201px 201px, rgb(243, 170, 96) -202px 202px, rgb(243, 170, 96) -203px 203px, rgb(243, 170, 96) -204px 204px, rgb(243, 170, 96) -205px 205px, rgb(243, 170, 96) -206px 206px, rgb(243, 170, 96) -207px 207px, rgb(243, 170, 96) -208px 208px, rgb(243, 170, 96) -209px 209px, rgb(243, 170, 96) -210px 210px, rgb(243, 170, 96) -211px 211px, rgb(243, 170, 96) -212px 212px, rgb(243, 170, 96) -213px 213px, rgb(243, 170, 96) -214px 214px, rgb(243, 170, 96) -215px 215px, rgb(243, 170, 96) -216px 216px, rgb(243, 170, 96) -217px 217px, rgb(243, 170, 96) -218px 218px, rgb(243, 170, 96) -219px 219px, rgb(243, 170, 96) -220px 220px, rgb(243, 170, 96) -221px 221px, rgb(243, 170, 96) -222px 222px, rgb(243, 170, 96) -223px 223px, rgb(243, 170, 96) -224px 224px, rgb(243, 170, 96) -225px 225px, rgb(243, 170, 96) -226px 226px, rgb(243, 170, 96) -227px 227px, rgb(243, 170, 96) -228px 228px, rgb(243, 170, 96) -229px 229px, rgb(243, 170, 96) -230px 230px, rgb(243, 170, 96) -231px 231px, rgb(243, 170, 96) -232px 232px, rgb(243, 170, 96) -233px 233px, rgb(243, 170, 96) -234px 234px, rgb(243, 170, 96) -235px 235px, rgb(243, 170, 96) -236px 236px, rgb(243, 170, 96) -237px 237px, rgb(243, 170, 96) -238px 238px, rgb(243, 170, 96) -239px 239px, rgb(243, 170, 96) -240px 240px, rgb(243, 170, 96) -241px 241px, rgb(243, 170, 96) -242px 242px, rgb(243, 170, 96) -243px 243px, rgb(243, 170, 96) -244px 244px, rgb(243, 170, 96) -245px 245px, rgb(243, 170, 96) -246px 246px, rgb(243, 170, 96) -247px 247px, rgb(243, 170, 96) -248px 248px, rgb(243, 170, 96) -249px 249px, rgb(243, 170, 96) -250px 250px, rgb(243, 170, 96) -251px 251px, rgb(243, 170, 96) -252px 252px, rgb(243, 170, 96) -253px 253px, rgb(243, 170, 96) -254px 254px, rgb(243, 170, 96) -255px 255px, rgb(243, 170, 96) -256px 256px, rgb(243, 170, 96) -257px 257px, rgb(243, 170, 96) -258px 258px, rgb(243, 170, 96) -259px 259px, rgb(243, 170, 96) -260px 260px, rgb(243, 170, 96) -261px 261px, rgb(243, 170, 96) -262px 262px, rgb(243, 170, 96) -263px 263px, rgb(243, 170, 96) -264px 264px, rgb(243, 170, 96) -265px 265px, rgb(243, 170, 96) -266px 266px, rgb(243, 170, 96) -267px 267px, rgb(243, 170, 96) -268px 268px, rgb(243, 170, 96) -269px 269px, rgb(243, 170, 96) -270px 270px, rgb(243, 170, 96) -271px 271px, rgb(243, 170, 96) -272px 272px, rgb(243, 170, 96) -273px 273px, rgb(243, 170, 96) -274px 274px, rgb(243, 170, 96) -275px 275px, rgb(243, 170, 96) -276px 276px, rgb(243, 170, 96) -277px 277px, rgb(243, 170, 96) -278px 278px, rgb(243, 170, 96) -279px 279px, rgb(243, 170, 96) -280px 280px, rgb(243, 170, 96) -281px 281px, rgb(243, 170, 96) -282px 282px, rgb(243, 170, 96) -283px 283px, rgb(243, 170, 96) -284px 284px, rgb(243, 170, 96) -285px 285px, rgb(243, 170, 96) -286px 286px, rgb(243, 170, 96) -287px 287px, rgb(243, 170, 96) -288px 288px, rgb(243, 170, 96) -289px 289px, rgb(243, 170, 96) -290px 290px, rgb(243, 170, 96) -291px 291px, rgb(243, 170, 96) -292px 292px, rgb(243, 170, 96) -293px 293px, rgb(243, 170, 96) -294px 294px, rgb(243, 170, 96) -295px 295px, rgb(243, 170, 96) -296px 296px, rgb(243, 170, 96) -297px 297px, rgb(243, 170, 96) -298px 298px, rgb(243, 170, 96) -299px 299px, rgb(243, 170, 96) -300px 300px, rgb(243, 170, 96) -301px 301px, rgb(243, 170, 96) -302px 302px, rgb(243, 170, 96) -303px 303px, rgb(243, 170, 96) -304px 304px, rgb(243, 170, 96) -305px 305px, rgb(243, 170, 96) -306px 306px, rgb(243, 170, 96) -307px 307px, rgb(243, 170, 96) -308px 308px, rgb(243, 170, 96) -309px 309px, rgb(243, 170, 96) -310px 310px, rgb(243, 170, 96) -311px 311px, rgb(243, 170, 96) -312px 312px, rgb(243, 170, 96) -313px 313px, rgb(243, 170, 96) -314px 314px, rgb(243, 170, 96) -315px 315px, rgb(243, 170, 96) -316px 316px, rgb(243, 170, 96) -317px 317px, rgb(243, 170, 96) -318px 318px, rgb(243, 170, 96) -319px 319px, rgb(243, 170, 96) -320px 320px, rgb(243, 170, 96) -321px 321px, rgb(243, 170, 96) -322px 322px, rgb(243, 170, 96) -323px 323px, rgb(243, 170, 96) -324px 324px, rgb(243, 170, 96) -325px 325px, rgb(243, 170, 96) -326px 326px, rgb(243, 170, 96) -327px 327px, rgb(243, 170, 96) -328px 328px, rgb(243, 170, 96) -329px 329px, rgb(243, 170, 96) -330px 330px, rgb(243, 170, 96) -331px 331px, rgb(243, 170, 96) -332px 332px, rgb(243, 170, 96) -333px 333px, rgb(243, 170, 96) -334px 334px, rgb(243, 170, 96) -335px 335px, rgb(243, 170, 96) -336px 336px, rgb(243, 170, 96) -337px 337px, rgb(243, 170, 96) -338px 338px, rgb(243, 170, 96) -339px 339px, rgb(243, 170, 96) -340px 340px, rgb(243, 170, 96) -341px 341px, rgb(243, 170, 96) -342px 342px, rgb(243, 170, 96) -343px 343px, rgb(243, 170, 96) -344px 344px, rgb(243, 170, 96) -345px 345px, rgb(243, 170, 96) -346px 346px, rgb(243, 170, 96) -347px 347px, rgb(243, 170, 96) -348px 348px, rgb(243, 170, 96) -349px 349px, rgb(243, 170, 96) -350px 350px, rgb(243, 170, 96) -351px 351px, rgb(243, 170, 96) -352px 352px, rgb(243, 170, 96) -353px 353px, rgb(243, 170, 96) -354px 354px, rgb(243, 170, 96) -355px 355px, rgb(243, 170, 96) -356px 356px, rgb(243, 170, 96) -357px 357px, rgb(243, 170, 96) -358px 358px, rgb(243, 170, 96) -359px 359px, rgb(243, 170, 96) -360px 360px, rgb(243, 170, 96) -361px 361px, rgb(243, 170, 96) -362px 362px, rgb(243, 170, 96) -363px 363px, rgb(243, 170, 96) -364px 364px, rgb(243, 170, 96) -365px 365px, rgb(243, 170, 96) -366px 366px, rgb(243, 170, 96) -367px 367px, rgb(243, 170, 96) -368px 368px, rgb(243, 170, 96) -369px 369px, rgb(243, 170, 96) -370px 370px, rgb(243, 170, 96) -371px 371px, rgb(243, 170, 96) -372px 372px, rgb(243, 170, 96) -373px 373px, rgb(243, 170, 96) -374px 374px, rgb(243, 170, 96) -375px 375px, rgb(243, 170, 96) -376px 376px, rgb(243, 170, 96) -377px 377px, rgb(243, 170, 96) -378px 378px, rgb(243, 170, 96) -379px 379px, rgb(243, 170, 96) -380px 380px, rgb(243, 170, 96) -381px 381px, rgb(243, 170, 96) -382px 382px, rgb(243, 170, 96) -383px 383px, rgb(243, 170, 96) -384px 384px, rgb(243, 170, 96) -385px 385px, rgb(243, 170, 96) -386px 386px, rgb(243, 170, 96) -387px 387px, rgb(243, 170, 96) -388px 388px, rgb(243, 170, 96) -389px 389px, rgb(243, 170, 96) -390px 390px, rgb(243, 170, 96) -391px 391px, rgb(243, 170, 96) -392px 392px, rgb(243, 170, 96) -393px 393px, rgb(243, 170, 96) -394px 394px, rgb(243, 170, 96) -395px 395px, rgb(243, 170, 96) -396px 396px, rgb(243, 170, 96) -397px 397px, rgb(243, 170, 96) -398px 398px, rgb(243, 170, 96) -399px 399px, rgb(243, 170, 96) -400px 400px, rgb(243, 170, 96) -401px 401px, rgb(243, 170, 96) -402px 402px, rgb(243, 170, 96) -403px 403px, rgb(243, 170, 96) -404px 404px, rgb(243, 170, 96) -405px 405px, rgb(243, 170, 96) -406px 406px, rgb(243, 170, 96) -407px 407px, rgb(243, 170, 96) -408px 408px, rgb(243, 170, 96) -409px 409px, rgb(243, 170, 96) -410px 410px, rgb(243, 170, 96) -411px 411px, rgb(243, 170, 96) -412px 412px, rgb(243, 170, 96) -413px 413px, rgb(243, 170, 96) -414px 414px, rgb(243, 170, 96) -415px 415px, rgb(243, 170, 96) -416px 416px, rgb(243, 170, 96) -417px 417px, rgb(243, 170, 96) -418px 418px, rgb(243, 170, 96) -419px 419px, rgb(243, 170, 96) -420px 420px, rgb(243, 170, 96) -421px 421px, rgb(243, 170, 96) -422px 422px, rgb(243, 170, 96) -423px 423px, rgb(243, 170, 96) -424px 424px, rgb(243, 170, 96) -425px 425px, rgb(243, 170, 96) -426px 426px, rgb(243, 170, 96) -427px 427px, rgb(243, 170, 96) -428px 428px, rgb(243, 170, 96) -429px 429px, rgb(243, 170, 96) -430px 430px, rgb(243, 170, 96) -431px 431px, rgb(243, 170, 96) -432px 432px, rgb(243, 170, 96) -433px 433px, rgb(243, 170, 96) -434px 434px, rgb(243, 170, 96) -435px 435px, rgb(243, 170, 96) -436px 436px, rgb(243, 170, 96) -437px 437px, rgb(243, 170, 96) -438px 438px, rgb(243, 170, 96) -439px 439px, rgb(243, 170, 96) -440px 440px, rgb(243, 170, 96) -441px 441px, rgb(243, 170, 96) -442px 442px, rgb(243, 170, 96) -443px 443px, rgb(243, 170, 96) -444px 444px, rgb(243, 170, 96) -445px 445px, rgb(243, 170, 96) -446px 446px, rgb(243, 170, 96) -447px 447px, rgb(243, 170, 96) -448px 448px, rgb(243, 170, 96) -449px 449px, rgb(243, 170, 96) -450px 450px, rgb(243, 170, 96) -451px 451px, rgb(243, 170, 96) -452px 452px, rgb(243, 170, 96) -453px 453px, rgb(243, 170, 96) -454px 454px, rgb(243, 170, 96) -455px 455px, rgb(243, 170, 96) -456px 456px, rgb(243, 170, 96) -457px 457px, rgb(243, 170, 96) -458px 458px, rgb(243, 170, 96) -459px 459px, rgb(243, 170, 96) -460px 460px, rgb(243, 170, 96) -461px 461px, rgb(243, 170, 96) -462px 462px, rgb(243, 170, 96) -463px 463px, rgb(243, 170, 96) -464px 464px, rgb(243, 170, 96) -465px 465px, rgb(243, 170, 96) -466px 466px, rgb(243, 170, 96) -467px 467px, rgb(243, 170, 96) -468px 468px, rgb(243, 170, 96) -469px 469px, rgb(243, 170, 96) -470px 470px, rgb(243, 170, 96) -471px 471px, rgb(243, 170, 96) -472px 472px, rgb(243, 170, 96) -473px 473px, rgb(243, 170, 96) -474px 474px, rgb(243, 170, 96) -475px 475px, rgb(243, 170, 96) -476px 476px, rgb(243, 170, 96) -477px 477px, rgb(243, 170, 96) -478px 478px, rgb(243, 170, 96) -479px 479px, rgb(243, 170, 96) -480px 480px, rgb(243, 170, 96) -481px 481px, rgb(243, 170, 96) -482px 482px, rgb(243, 170, 96) -483px 483px, rgb(243, 170, 96) -484px 484px, rgb(243, 170, 96) -485px 485px, rgb(243, 170, 96) -486px 486px, rgb(243, 170, 96) -487px 487px, rgb(243, 170, 96) -488px 488px, rgb(243, 170, 96) -489px 489px, rgb(243, 170, 96) -490px 490px, rgb(243, 170, 96) -491px 491px, rgb(243, 170, 96) -492px 492px, rgb(243, 170, 96) -493px 493px, rgb(243, 170, 96) -494px 494px, rgb(243, 170, 96) -495px 495px, rgb(243, 170, 96) -496px 496px, rgb(243, 170, 96) -497px 497px, rgb(243, 170, 96) -498px 498px, rgb(243, 170, 96) -499px 499px, rgba(0, 0, 0, 0.4) -10px 0px 15px, rgba(0, 0, 0, 0.4) -20px 10px 15px, rgba(0, 0, 0, 0.4) -30px 20px 15px, rgba(0, 0, 0, 0.4) -40px 30px 15px, rgba(0, 0, 0, 0.4) -50px 40px 15px, rgba(0, 0, 0, 0.4) -60px 50px 15px, rgba(0, 0, 0, 0.4) -70px 60px 15px, rgba(0, 0, 0, 0.4) -80px 70px 15px, rgba(0, 0, 0, 0.4) -90px 80px 15px, rgba(0, 0, 0, 0.4) -100px 90px 15px, rgba(0, 0, 0, 0.4) -110px 100px 15px, rgba(0, 0, 0, 0.4) -120px 110px 15px, rgba(0, 0, 0, 0.4) -130px 120px 15px, rgba(0, 0, 0, 0.4) -140px 130px 15px, rgba(0, 0, 0, 0.4) -150px 140px 15px, rgba(0, 0, 0, 0.4) -160px 150px 15px, rgba(0, 0, 0, 0.4) -170px 160px 15px, rgba(0, 0, 0, 0.4) -180px 170px 15px, rgba(0, 0, 0, 0.4) -190px 180px 15px, rgba(0, 0, 0, 0.4) -200px 190px 15px, rgba(0, 0, 0, 0.4) -210px 200px 15px, rgba(0, 0, 0, 0.4) -220px 210px 15px, rgba(0, 0, 0, 0.4) -230px 220px 15px, rgba(0, 0, 0, 0.4) -240px 230px 15px, rgba(0, 0, 0, 0.4) -250px 240px 15px, rgba(0, 0, 0, 0.4) -260px 250px 15px, rgba(0, 0, 0, 0.4) -270px 260px 15px, rgba(0, 0, 0, 0.4) -280px 270px 15px, rgba(0, 0, 0, 0.4) -290px 280px 15px, rgba(0, 0, 0, 0.4) -300px 290px 15px, rgba(0, 0, 0, 0.4) -310px 300px 15px, rgba(0, 0, 0, 0.4) -320px 310px 15px, rgba(0, 0, 0, 0.4) -330px 320px 15px, rgba(0, 0, 0, 0.4) -340px 330px 15px, rgba(0, 0, 0, 0.4) -350px 340px 15px, rgba(0, 0, 0, 0.4) -360px 350px 15px, rgba(0, 0, 0, 0.4) -370px 360px 15px, rgba(0, 0, 0, 0.4) -380px 370px 15px, rgba(0, 0, 0, 0.4) -390px 380px 15px, rgba(0, 0, 0, 0.4) -400px 390px 15px, rgba(0, 0, 0, 0.4) -410px 400px 15px, rgba(0, 0, 0, 0.4) -420px 410px 15px, rgba(0, 0, 0, 0.4) -430px 420px 15px, rgba(0, 0, 0, 0.4) -440px 430px 15px, rgba(0, 0, 0, 0.4) -450px 440px 15px, rgba(0, 0, 0, 0.4) -460px 450px 15px, rgba(0, 0, 0, 0.4) -470px 460px 15px, rgba(0, 0, 0, 0.4) -480px 470px 15px, rgba(0, 0, 0, 0.4) -490px 480px 15px, rgba(0, 0, 0, 0.4) -500px 490px 15px
}
                .ui-datepicker .ui-state-disabled {
                    color: #b0b0b0; /* Gray color */
                    background-color: #f0f0f0; /* Light gray background */
                    border: 1px solid #d0d0d0; /* Light gray border */
                    cursor: not-allowed; /* Change cursor to indicate the date is disabled */
                }

                .header {
                    position: relative;
                    overflow: hidden;
                    height: 33vh; /* Adjust height as needed */
                }

                .video-fullscreen-wrap {
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    overflow: hidden;
                }

                .video-fullscreen-video {
                    min-width: 100%;
                    min-height: 100%;
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    z-index: 0; /* Send video behind header */
                }

                .slogan-container {
                        position: absolute;
                        top: 60%;
                        right: 15%;
                        transform: translateY(-50%);
                        z-index: 1;
                        text-align: center;
                        }


                        .slogan-image {
                            max-width: 100%;
                            height: auto;
                            color: white;
                            font-weight: 50;
                            font-size: 18px;
                            margin-right: 0;
                            }

                @media (max-width: 768px) {

                .slogan-text {
                    display: block; /* Show alternative text */
                    text-align: center; /* Center text */
                }

                
            }


            @media (max-width: 480px) {
              

                .slogan-image {
                    max-width: 100%; /* Responsive image */
                    height: auto;
                    color: white;
                    font-weight: 50;
                    font-size: 15px;
                    text-align: center;
                }
            
                .slogan-text {
                    font-size: 20px;
                    text-align: center; /* Center text */
                }

                
            }

</style>

<script>
    $(document).ready(function(){
        $(".owl-carousel").owlCarousel({
            loop: true,                     // Enable continuous loop
            margin: 10,                     // Adjust margin between items
            nav: false,                     // Disable navigation buttons
            dots: false,                    // Hide pagination dots
            autoplay: true,                 // Enable autoplay
            autoplayTimeout: 1000,          // Time between slides (1 second)
            autoplayHoverPause: true,       // Pause on hover
            autoplaySpeed: 2000,             // Speed of transition between slides
            responsive: {
                0: {
                    items: 5             // 1 item on small screens
                },
                600: {
                    items: 3              // 3 items on medium screens
                },
                1000: {
                    items: 5              // 5 items on large screens
                }
            }
        });
    });

    $(document).ready(function(){
        $('.datepicker').datepicker({
            minDate: 0  // This ensures the user can only select today's date or any future date
        });
    });
    document.addEventListener('DOMContentLoaded', function() {
            flatpickr("#pickup_date", {
                enableTime: true,
                dateFormat: "Y-m-d H:i:S", // Sets the format to match the API requirement
                time_24hr: true,
                minDate: "today",
            });

            flatpickr("#return_date", {
                enableTime: true,
                dateFormat: "Y-m-d H:i:S",
                time_24hr: true,
                minDate: "today",
            });
        });
</script>


@section('content')


    <!-- Preloader -->
    <div class="preloader-bg"></div>
    <div id="preloader">
        <div id="preloader-status">
            <div class="preloader-position loader"><span></span></div>
        </div>
    </div>



    <!-- Header Video -->
    <header class="header">
        <div class="video-fullscreen-wrap">
            <div class="video-fullscreen-video" data-overlay-dark="2">
                <video playsinline autoplay loop muted>
                    <source src="https://duruthemes.com/demo/html/renax/video.mp4" type="video/mp4">
                    <source src="https://duruthemes.com/demo/html/renax/video.webm" type="video/webm">
                </video>
            </div>
            <div class="slogan-container">
                <h3 class="slogan-image" style="font-family: 'Calisto MT', serif;">The Right Car For Every Road - Rent Your Way</h3>
            </div>
        </div>
    </header>

    <!-- Clients Section -->
    <section class="clients mt-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="owl-carousel owl-theme">
                        @foreach(range(1, 11) as $i)
                            <div class="clients-logo">
                                <a href="#0"><img src="{{ asset('front/img/clients/' . $i . '.png') }}" alt=""></a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

<!-- Initialize Owl Carousel with your custom settings -->


        <!-- Luxury Cars Section -->
        <section class="cars2 section-padding my-0 py-0 px-3 mx-auto py-5 mt-5">
        
            <div class="row mt-4">
                <div class="col-12 position-relative d-flex justify-content-center align-items-center" style="background-color: white; width: 100vw;">
                    <!-- Centered Title -->
                    <div id="text-container">
                        <div id="line-one">
                            <h1 class="display-3 mb-4">LUXURY</h1>
                        </div>
                    </div>

                    <!-- Dropdown Filter -->
                    <!-- <select id="priceFilter" class="form-select" style="width: 200px; position: absolute; right: 10px;" onchange="this.form.submit()">
                        <option value="default">Filter By</option>
                        <option value="low-to-high" {{ request('price_filter') === 'low-to-high' ? 'selected' : '' }}>Price: Low to High</option>
                        <option value="high-to-low" {{ request('price_filter') === 'high-to-low' ? 'selected' : '' }}>Price: High to Low</option>
                    </select> -->
                </div>
            </div>

            <!-- Adjusting the row for luxury cars -->
            <div class="row gy-2 mt-4" style="background-color: white;">
                <!-- Loop through luxury cars only -->
                @foreach($cars as $car)
                    @if(strtolower($car->categories) === 'luxury')  <!-- Filter only luxury cars -->
                        <!-- Car Card -->
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-3" style="text-decoration: none;">
                            <div class="card3 w-100">
                                <span class="px-4 py-3" style="display: inline-block;">
                                    <h3 class="car_name" style="display: inline-block; margin: 0; font-size: 23px; font-family: 'Calisto MT', serif;">{{ $car->car_name . ' ' . $car->model}}</h3>
                                    <br>
                                    <h4 class="car_name" style="display:inline-block; margin:0; font-family: 'Calisto MT', serif;">{{ $car->year }}</h4>
                                </span>
                                <div class="span-group px-3 fw-bold" style="font-size: 12px; font-family: 'Calisto MT', serif;">
                                    <span>{{ $car->seats . ' Seats' }}</span>
                                    <span>{{ $car->doors . ' Doors' }}</span>
                                    <span>Automatic</span>
                                    <span style="background-color: #1B1B1B; color: white;">LUXURY</span>
                                </div>
                                <a href="{{ route('cars.show', $car->id) }}">
                                    <div>
                                        <img src="{{ asset('storage/' . $car->car_picture) }}" alt="Car Picture">
                                    </div>
                                </a>
                                <div class="row mb-5 gx-2 justify-content-center">
                                    <div class="col-4">
                                        <h4 class="text-center text-white" style="font-family: 'Calisto MT', serif; font-size:medium;">Daily</h4>
                                        <h6 class="text-center text-white fw-bold" style="font-family: 'Calisto MT', serif; font-size:large;">{{ $car->price_daily }} <span>AED</span></h6>
                                    </div>
                                    <div class="col-4">
                                        <h4 class="text-center text-white" style="font-family: 'Calisto MT', serif; font-size:medium;">Weekly</h4>
                                        <h6 class="text-center text-white fw-bold" style="font-family: 'Calisto MT', serif; font-size:large;">{{ $car->price_weekly }} <span>AED</span></h6>
                                    </div>
                                    <div class="col-4">
                                        <h4 class="text-center text-white" style="font-family: 'Calisto MT', serif; font-size:medium;">Monthly</h4>
                                        <h6 class="text-center text-white fw-bold" style="font-family: 'Calisto MT', serif; font-size:large;">{{ $car->price_monthly }} <span>AED</span></h6>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="mb-3 d-flex justify-content-start">
                                                <button class="btn text-center my-2" style="background-color: #949494; color: white; font-family: 'Calisto MT', serif;" data-bs-toggle="modal" data-bs-target="#bookingModal{{ $car->id }}">
                                                    Book Now
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-6 position-relative">
                                            <div class="mb-3">
                                                <!-- WhatsApp Icon as a clickable link -->
                                                <a href="https://wa.me/971542700030?text=Hi!%20I%20am%20interested%20in%20this%20car.%20Here%20is%20the%20link%20to%20the%20car:%20{{ route('cars.show', ['id' => $car->id]) }}%20and%20here%20is%20the%20image%20of%20the%20car:%20{{ asset('path/to/car-image.jpg') }}" target="_blank" class="position-absolute bottom-0 end-0 mb-4 me-3">
                                                    <i class="fab fa-whatsapp" style="font-size: 40px; color: #25D366;"></i> <!-- Larger WhatsApp icon -->
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Booking Modal -->
                        <div class="modal fade" id="bookingModal{{ $car->id }}" tabindex="-1" aria-labelledby="bookingModalLabel{{ $car->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="bookingModalLabel{{ $car->id }}">Booking Form for {{ $car->car_name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="booking-box">
                                            <div class="booking-inner clearfix">
                                                <form method="post" action="{{ route('form.submit') }}" class="form1 contact__form clearfix" id="bookingForm">
                                                    @csrf
                                                    <input type="hidden" name="car_id" value="{{ $car->id }}">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="alert alert-success contact__msg" style="display: none" role="alert"> Your message was sent successfully. </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-12">
                                                            <label>Car Name</label>
                                                            <input name="carName" type="text" class="form-control" value="{{ $car->car_name . ' ' . $car->model . ' ' . $car->year }}" readonly>
                                                        </div>
                                                        <div class="col-lg-6 col-md-12">
                                                            <label>Car ID</label>
                                                            <input type="text" class="form-control" value="{{ $car->id }}" name="carID" readonly>
                                                        </div>
                                                        <input type="hidden" name="plate_number" value="{{ $car->plate_number }}">
                                                        <input type="hidden" name="price_daily" value="{{ $car->price_daily }}">

                                                        <div class="col-lg-6 col-md-12">
                                                            <input name="name" type="text" placeholder="Full Name *" required>
                                                        </div>
                                                        <div class="col-lg-6 col-md-12">
                                                            <input name="email" type="email" placeholder="Email *" required>
                                                        </div>
                                                        <div class="col-lg-6 col-md-12">
                                                            <input name="phone" type="text" placeholder="Phone *" required>
                                                        </div>
                                                        <div class="col-lg-6 col-md-12">
                                                            <div class="select1_wrapper">
                                                                <label>Pick Up Location</label>
                                                                <div class="select1_inner">
                                                                    <select name="pickup_city" class="select2 select" style="width: 100%" required>
                                                                        <option value="" disabled selected>Select a City</option>
                                                                        <option value="Dubai">Dubai</option>
                                                                        <option value="Sharjah">Sharjah</option>
                                                                        <option value="Alain">Alain</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-12">
                                                            <div class="input1_wrapper">
                                                                <label>Pick Up Date and Time</label>
                                                                <div class="input1_inner">
                                                                    <input id="pickup_date" name="pickup_date" type="text" class="form-control input1 datepicker" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-12">
                                                            <input type="submit" value="Submit" id="bookingSubmit" class="btn1 btn1__primary">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </section>




        <!-- Mid Range Section -->
        <section class="cars2 section-padding my-0 py-0 px-3 mx-auto py-5 mt-5">
            <div class="row mt-4">
                <div class="col-12 position-relative d-flex justify-content-center align-items-center" style="background-color: white; width: 100vw;">
                    <div id="text-container">
                        <div id="line-one">
                            <h1 class="display-3">Mid Range</h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row gy-2">
                @foreach($cars as $car)
                    @if(strtolower($car->categories) == 'mid range') <!-- Check if category is 'mid range' -->
                        <!-- Car Card -->
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-3" style="text-decoration: none;">
                            <div class="card3 w-100">
                                <span class="px-4 py-3" style="display: inline-block;">
                                    <h3 class="car_name" style="display: inline-block; margin: 0; font-size: 23px; font-family: 'Calisto MT', serif;">{{ $car->car_name . ' ' . $car->model }}</h3>
                                    <br>
                                    <h4 class="car_name" style="display:inline-block; margin:0; font-family: 'Calisto MT', serif;">{{ $car->year }}</h4>
                                </span>
                                <div class="span-group px-3 fw-bold" style="font-size: 12px; font-family: 'Calisto MT', serif;">
                                    <span>{{ $car->seats . ' Seats' }}</span>
                                    <span>{{ $car->doors . ' Doors' }}</span>
                                    <span>Automatic</span>
                                    <span style="background-color: green;">
                                        {{ $car->categories }}
                                    </span>
                                </div>
                                <a href="{{ route('cars.show', $car->id) }}">
                                    <div>
                                        <img src="{{ asset('storage/' . $car->car_picture) }}" alt="Car Picture">
                                    </div>
                                </a>
                                <div class="row mb-5 gx-2 justify-content-center">
                                    <div class="col-4">
                                        <h4 class="text-center text-white" style="font-family: 'Calisto MT', serif; font-size:medium;">Daily</h4>
                                        <h6 class="text-center text-white fw-bold" style="font-family: 'Calisto MT', serif; font-size:large;">{{ $car->price_daily }} <span>AED</span></h6>
                                    </div>

                                    <div class="col-4">
                                        <h4 class="text-center text-white" style="font-family: 'Calisto MT', serif; font-size:medium;">Weekly</h4>
                                        <h6 class="text-center text-white fw-bold" style="font-family: 'Calisto MT', serif; font-size:large;">{{ $car->price_weekly }} <span>AED</span></h6>
                                    </div>

                                    <div class="col-4">
                                        <h4 class="text-center text-white" style="font-family: 'Calisto MT', serif; font-size:medium;">Monthly</h4>
                                        <h6 class="text-center text-white fw-bold" style="font-family: 'Calisto MT', serif; font-size:large;">{{ $car->price_monthly }} <span>AED</span></h6>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="mb-3 d-flex justify-content-start">
                                                <button class="btn text-center my-2" style="background-color: #949494; color: white; font-family: 'Calisto MT', serif;" data-bs-toggle="modal" data-bs-target="#bookingModal{{ $car->id }}">
                                                    Book Now
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-6 position-relative">
                                            <div class="mb-3">
                                                <!-- WhatsApp Icon as a clickable link -->
                                                <a href="https://wa.me/971542700030?text=Hi!%20I%20am%20interested%20in%20this%20car.%20Here%20is%20the%20link%20to%20the%20car:%20{{ route('cars.show', ['id' => $car->id]) }}%20and%20here%20is%20the%20image%20of%20the%20car:%20{{ asset('path/to/car-image.jpg') }}" target="_blank" class="position-absolute bottom-0 end-0 mb-4 me-3">
                                                    <i class="fab fa-whatsapp" style="font-size: 40px; color: #25D366;"></i> <!-- Larger WhatsApp icon -->
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Booking Modal -->
                        <div class="modal fade" id="bookingModal{{ $car->id }}" tabindex="-1" aria-labelledby="bookingModalLabel{{ $car->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="bookingModalLabel{{ $car->id }}">Booking Form for {{ $car->car_name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="booking-box">
                                            <div class="booking-inner clearfix">
                                                <form method="post" action="{{ route('form.submit') }}" class="form1 contact__form clearfix" id="bookingForm">
                                                    @csrf
                                                    <input type="hidden" name="car_id" value="{{ $car->id }}">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="alert alert-success contact__msg" style="display: none" role="alert"> Your message was sent successfully. </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-12">
                                                            <label>Car Name</label>
                                                            <input name="carName" type="text" class="form-control" value="{{ $car->car_name . ' ' . $car->model . ' ' . $car->year }}" readonly>
                                                        </div>
                                                        <div class="col-lg-6 col-md-12">
                                                            <label>Car ID</label>
                                                            <input type="text" class="form-control" value="{{ $car->id }}" name="carID" readonly>
                                                        </div>
                                                        <input type="hidden" name="plate_number" value="{{ $car->plate_number }}">
                                                        <input type="hidden" name="price_daily" value="{{ $car->price_daily }}">

                                                        <div class="col-lg-6 col-md-12">
                                                            <input name="name" type="text" placeholder="Full Name *" required>
                                                        </div>
                                                        <div class="col-lg-6 col-md-12">
                                                            <input name="email" type="email" placeholder="Email *" required>
                                                        </div>
                                                        <div class="col-lg-6 col-md-12">
                                                            <input name="phone" type="text" placeholder="Phone *" required>
                                                        </div>
                                                        <div class="col-lg-6 col-md-12">
                                                            <div class="select1_wrapper">
                                                                <label>Pick Up Location</label>
                                                                <div class="select1_inner">
                                                                    <select name="pickup_city" class="select2 select" style="width: 100%" required>
                                                                        <option value="" disabled selected>Select a City</option>
                                                                        <option value="Dubai">Dubai</option>
                                                                        <option value="Sharjah">Sharjah</option>
                                                                        <option value="Alain">Alain</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-12">
                                                            <div class="input1_wrapper">
                                                                <label>Pick Up Date and Time</label>
                                                                <div class="input1_inner">
                                                                    <input id="pickup_date" name="pickup_date" type="text" class="form-control input" placeholder="Pick Up Date and Time" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6 col-md-12">
                                                            <div class="input1_wrapper">
                                                                <label>Return Up Date and Time</label>
                                                                <div class="input1_inner">
                                                                    <input id="return_date" name="return_date" type="text" class="form-control input" placeholder="Return Up Date and Time" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12 form-group">
                                                            <textarea name="message" id="message" cols="30" rows="4" placeholder="Additional Note"></textarea>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12">
                                                            <input type="hidden" name="daily_car_price" value="{{ $car->price_daily }}">
                                                            <button type="submit" class="submit1_btn">Submit</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </section>



       <!-- Economy Section -->
        <section class="cars2 section-padding my-0 py-0 px-3 mx-auto py-5 mt-5">
            <div class="row mt-4">
                <div class="col-12 position-relative d-flex justify-content-center align-items-center" style="background-color: white; width: 100vw;">
                    <div id="text-container">
                        <div id="line-one">
                            <h1 class="display-3">Economy</h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row gy-2">
                @foreach($cars as $car)
                    @if(strtolower($car->categories) == 'economy') <!-- Check if category is 'economy' -->
                        <!-- Car Card -->
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-3" style="text-decoration: none;">
                            <div class="card3 w-100">
                                <span class="px-4 py-3" style="display: inline-block;">
                                    <h3 class="car_name" style="display: inline-block; margin: 0; font-size: 23px; font-family: 'Calisto MT', serif;">{{ $car->car_name . ' ' . $car->model }}</h3>
                                    <br>
                                    <h4 class="car_name" style="display: inline-block; margin: 0; font-family: 'Calisto MT', serif;">{{ $car->year }}</h4>
                                </span>
                                <div class="span-group px-3 fw-bold" style="font-size: 12px; font-family: 'Calisto MT', serif;">
                                    <span>{{ $car->seats . ' Seats' }}</span>
                                    <span>{{ $car->doors . ' Doors' }}</span>
                                    <span>Automatic</span>
                                    <span style="background-color: orange;">
                                        {{ $car->categories }}
                                    </span>
                                </div>
                                <a href="{{ route('cars.show', $car->id) }}">
                                    <div>
                                        <img src="{{ asset('storage/' . $car->car_picture) }}" alt="Car Picture">
                                    </div>
                                </a>
                                <div class="row mb-5 gx-2 justify-content-center">
                                    <div class="col-4">
                                        <h4 class="text-center text-white" style="font-family: 'Calisto MT', serif; font-size: medium;">Daily</h4>
                                        <h6 class="text-center text-white fw-bold" style="font-family: 'Calisto MT', serif; font-size: large;">{{ $car->price_daily }} <span>AED</span></h6>
                                    </div>

                                    <div class="col-4">
                                        <h4 class="text-center text-white" style="font-family: 'Calisto MT', serif; font-size: medium;">Weekly</h4>
                                        <h6 class="text-center text-white fw-bold" style="font-family: 'Calisto MT', serif; font-size: large;">{{ $car->price_weekly }} <span>AED</span></h6>
                                    </div>

                                    <div class="col-4">
                                        <h4 class="text-center text-white" style="font-family: 'Calisto MT', serif; font-size: medium;">Monthly</h4>
                                        <h6 class="text-center text-white fw-bold" style="font-family: 'Calisto MT', serif; font-size: large;">{{ $car->price_monthly }} <span>AED</span></h6>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="mb-3 d-flex justify-content-start">
                                                <button class="btn text-center my-2" style="background-color: #949494; color: white; font-family: 'Calisto MT', serif;" data-bs-toggle="modal" data-bs-target="#bookingModal{{ $car->id }}">
                                                    Book Now
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-6 position-relative">
                                            <div class="mb-3">
                                                <!-- WhatsApp Icon as a clickable link -->
                                                <a href="https://wa.me/971542700030?text=Hi!%20I%20am%20interested%20in%20this%20car.%20Here%20is%20the%20link%20to%20the%20car:%20{{ route('cars.show', ['id' => $car->id]) }}%20and%20here%20is%20the%20image%20of%20the%20car:%20{{ asset('path/to/car-image.jpg') }}" target="_blank" class="position-absolute bottom-0 end-0 mb-4 me-3">
                                                    <i class="fab fa-whatsapp" style="font-size: 40px; color: #25D366;"></i> <!-- Larger WhatsApp icon -->
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Booking Modal -->
                        <div class="modal fade" id="bookingModal{{ $car->id }}" tabindex="-1" aria-labelledby="bookingModalLabel{{ $car->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="bookingModalLabel{{ $car->id }}">Booking Form for {{ $car->car_name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="booking-box">
                                            <div class="booking-inner clearfix">
                                                <form method="post" action="{{ route('form.submit') }}" class="form1 contact__form clearfix" id="bookingForm">
                                                    @csrf
                                                    <input type="hidden" name="car_id" value="{{ $car->id }}">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="alert alert-success contact__msg" style="display: none" role="alert"> Your message was sent successfully. </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-12">
                                                            <label>Car Name</label>
                                                            <input name="carName" type="text" class="form-control" value="{{ $car->car_name . ' ' . $car->model . ' ' . $car->year }}" readonly>
                                                        </div>
                                                        <div class="col-lg-6 col-md-12">
                                                            <label>Car ID</label>
                                                            <input type="text" class="form-control" value="{{ $car->id }}" name="carID" readonly>
                                                        </div>
                                                        <input type="hidden" name="plate_number" value="{{ $car->plate_number }}">
                                                        <input type="hidden" name="price_daily" value="{{ $car->price_daily }}">

                                                        <div class="col-lg-6 col-md-12">
                                                            <input name="name" type="text" placeholder="Full Name *" required>
                                                        </div>
                                                        <div class="col-lg-6 col-md-12">
                                                            <input name="email" type="email" placeholder="Email *" required>
                                                        </div>
                                                        <div class="col-lg-6 col-md-12">
                                                            <input name="phone" type="text" placeholder="Phone *" required>
                                                        </div>
                                                        <div class="col-lg-6 col-md-12">
                                                            <div class="select1_wrapper">
                                                                <label>Pick Up Location</label>
                                                                <div class="select1_inner">
                                                                    <select name="pickup_city" class="select2 select" style="width: 100%" required>
                                                                        <option value="" disabled selected>Select a City</option>
                                                                        <option value="Dubai">Dubai</option>
                                                                        <option value="Sharjah">Sharjah</option>
                                                                        <option value="Alain">Alain</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-12">
                                                            <div class="input1_wrapper">
                                                                <label>Pick Up Date and Time</label>
                                                                <div class="input1_inner">
                                                                    <input id="pickup_date" name="pickup_date" type="text" class="form-control input" placeholder="Pick Up Date and Time" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6 col-md-12">
                                                            <div class="input1_wrapper">
                                                                <label>Return Up Date and Time</label>
                                                                <div class="input1_inner">
                                                                    <input id="return_date" name="return_date" type="text" class="form-control input" placeholder="Return Up Date and Time" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12 form-group">
                                                            <textarea name="message" id="message" cols="30" rows="4" placeholder="Additional Note"></textarea>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12">
                                                            <input type="hidden" name="car_price" value="{{ $car->price_daily }}">
                                                            <button type="submit" class="btn btn-primary">Reserve Now</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Booking Modal -->
                    @endif
                @endforeach
            </div>
        </section>


        <!-- Sport Section -->
        <section class="cars2 section-padding my-0 py-0 px-3 mx-auto py-5 mt-5">
            <div class="row mt-4">
                <div class="col-12 position-relative d-flex justify-content-center align-items-center" style="background-color: white; width: 100vw;">
                    <div id="text-container">
                        <div id="line-one">
                            <h1 class="display-3">
                                Sports and Exotics
                            </h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row gy-2">
                @foreach($cars as $car)
                    @if(strtolower($car->categories) == 'sports and exotics')
                        <!-- Car Card -->
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-3" style="text-decoration: none;">
                            <div class="card3 w-100">
                                <span class="px-4 py-3" style="display: inline-block;">
                                    <h3 class="car_name" style="display: inline-block; margin: 0; font-size: 23px; font-family: 'Calisto MT', serif;">{{ $car->car_name . ' ' . $car->model }}</h3>
                                    <br>
                                    <h4 class="car_name" style="display:inline-block; margin:0; font-family: 'Calisto MT', serif;">{{ $car->year }}</h4>
                                </span>
                                <div class="span-group px-3 fw-bold" style="font-size: 12px; font-family: 'Calisto MT', serif;">
                                    <span>{{ $car->seats . ' Seats' }}</span>
                                    <span>{{ $car->doors . ' Doors' }}</span>
                                    <span>Automatic</span>
                                    <span style="background-color: blue;">
                                        {{ $car->categories }}
                                    </span>
                                </div>

                                <a href="{{ route('cars.show', $car->id) }}">
                                    <div>
                                        <img src="{{ asset('storage/' . $car->car_picture) }}" alt="Car Picture">
                                    </div>
                                </a>

                                <div class="row mb-5 gx-2 justify-content-center">
                                    <div class="col-4">
                                        <h4 class="text-center text-white" style="font-family: 'Calisto MT', serif; font-size:medium;">Daily</h4>
                                        <h6 class="text-center text-white fw-bold" style="font-family: 'Calisto MT', serif; font-size:large;">{{ $car->price_daily }} <span>AED</span></h6>
                                    </div>

                                    <div class="col-4">
                                        <h4 class="text-center text-white" style="font-family: 'Calisto MT', serif; font-size:medium;">Weekly</h4>
                                        <h6 class="text-center text-white fw-bold" style="font-family: 'Calisto MT', serif; font-size:large;">{{ $car->price_weekly }} <span>AED</span></h6>
                                    </div>

                                    <div class="col-4">
                                        <h4 class="text-center text-white" style="font-family: 'Calisto MT', serif; font-size:medium;">Monthly</h4>
                                        <h6 class="text-center text-white fw-bold" style="font-family: 'Calisto MT', serif; font-size:large;">{{ $car->price_monthly }} <span>AED</span></h6>
                                    </div>

                                    <div class="row">
                                        <div class="col-6">
                                            <div class="mb-3 d-flex justify-content-start">
                                                <button class="btn text-center my-2" style="background-color: #949494; color: white; font-family: 'Calisto MT', serif;" data-bs-toggle="modal" data-bs-target="#bookingModal{{ $car->id }}">
                                                    Book Now
                                                </button>
                                            </div>
                                        </div>

                                        <div class="col-6 position-relative">
                                            <div class="mb-3">
                                                <!-- WhatsApp Icon as a clickable link -->
                                                <a href="https://wa.me/971542700030?text=Hi!%20I%20am%20interested%20in%20this%20car.%20Here%20is%20the%20link%20to%20the%20car:%20{{ route('cars.show', ['id' => $car->id]) }}%20and%20here%20is%20the%20image%20of%20the%20car:%20{{ asset('storage/' . $car->car_picture) }}" target="_blank" class="position-absolute bottom-0 end-0 mb-4 me-3">
                                                    <i class="fab fa-whatsapp" style="font-size: 40px; color: #25D366;"></i> <!-- Larger WhatsApp icon -->
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Booking Modal -->
                        <div class="modal fade" id="bookingModal{{ $car->id }}" tabindex="-1" aria-labelledby="bookingModalLabel{{ $car->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="bookingModalLabel{{ $car->id }}">Booking Form for {{ $car->car_name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="booking-box">
                                            <div class="booking-inner clearfix">
                                                <form method="post" action="{{ route('form.submit') }}" class="form1 contact__form clearfix" id="bookingForm">
                                                    @csrf
                                                    <input type="hidden" name="car_id" value="{{ $car->id }}">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="alert alert-success contact__msg" style="display: none" role="alert"> Your message was sent successfully. </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-12">
                                                            <label>Car Name</label>
                                                            <input name="carName" type="text" class="form-control" value="{{ $car->car_name . ' ' . $car->model . ' ' . $car->year }}" readonly>
                                                        </div>
                                                        <div class="col-lg-6 col-md-12">
                                                            <label>Car ID</label>
                                                            <input type="text" class="form-control" value="{{ $car->id }}" name="carID" readonly>
                                                        </div>
                                                        <input type="hidden" name="plate_number" value="{{ $car->plate_number }}">
                                                        <input type="hidden" name="price_daily" value="{{ $car->price_daily }}">

                                                        <div class="col-lg-6 col-md-12">
                                                            <input name="name" type="text" placeholder="Full Name *" required>
                                                        </div>
                                                        <div class="col-lg-6 col-md-12">
                                                            <input name="email" type="email" placeholder="Email *" required>
                                                        </div>
                                                        <div class="col-lg-6 col-md-12">
                                                            <input name="phone" type="text" placeholder="Phone *" required>
                                                        </div>
                                                        <div class="col-lg-6 col-md-12">
                                                            <div class="select1_wrapper">
                                                                <label>Pick Up Location</label>
                                                                <div class="select1_inner">
                                                                    <select name="pickup_city" class="select2 select" style="width: 100%" required>
                                                                        <option value="" disabled selected>Select a City</option>
                                                                        <option value="Dubai">Dubai</option>
                                                                        <option value="Sharjah">Sharjah</option>
                                                                        <option value="Alain">Alain</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-12">
                                                            <div class="input1_wrapper">
                                                                <label>Pick Up Date and Time</label>
                                                                <div class="input1_inner">
                                                                    <input id="pickup_date" name="pickup_date" type="text" class="form-control input" placeholder="Pick Up Date and Time" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6 col-md-12">
                                                            <div class="input1_wrapper">
                                                                <label>Return Up Date and Time</label>
                                                                <div class="input1_inner">
                                                                    <input id="return_date" name="return_date" type="text" class="form-control input" placeholder="Return Up Date and Time" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12 form-group">
                                                            <textarea name="message" id="message" cols="30" rows="4" placeholder="Additional Note"></textarea>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12">
                                                            <div class="text-center"><button class="btn text-center my-2" style="background-color: #949494; color: white;" type="submit">Submit Booking Request</button></div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </section>


        <section class="cars2 section-padding my-0 py-0 px-3 mx-auto py-5 mt-5">
            <div class="row mt-4">
                <div class="col-12 position-relative d-flex justify-content-center align-items-center" style="background-color: white; width: 100vw;">
                    <div id="text-container" class="mt-4 mb-4">
                        <div id="line-one">
                            <h1 class="display-3">
                                Vans and Buses
                            </h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row gy-2 mt-4">
                @foreach($cars as $car)
                    @if(strtolower($car->categories) == 'vans and buses')
                        <!-- Car Card -->
                        <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-3" style="text-decoration: none;">
                            <div class="card3 w-100">
                                <span class="px-4 py-3" style="display: inline-block;">
                                    <h3 class="car_name" style="display: inline-block; margin: 0; font-size: 23px; font-family: 'Calisto MT', serif;">{{ $car->car_name . ' ' . $car->model }}</h3>
                                    <br>
                                    <h4 class="car_name" style="display: inline-block; margin: 0; font-family: 'Calisto MT', serif;">{{ $car->year }}</h4>
                                </span>
                                <div class="span-group px-3 fw-bold" style="font-size: 12px; font-family: 'Calisto MT', serif;">
                                    <span>{{ $car->seats . ' Seats' }}</span>
                                    <span>{{ $car->doors . ' Doors' }}</span>
                                    <span>Automatic</span>
                                    <span style="background-color: blue;">
                                        {{ $car->categories }}
                                    </span>
                                </div>
                                <a href="{{ route('cars.show', $car->id) }}">
                                    <div>
                                        <img src="{{ asset('storage/' . $car->car_picture) }}" alt="Car Picture" class="w-100">
                                    </div>
                                </a>
                                <div class="row mb-5 gx-2 justify-content-center">
                                    <div class="col-4">
                                        <h4 class="text-center text-white" style="font-family: 'Calisto MT', serif; font-size: medium;">Daily</h4>
                                        <h6 class="text-center text-white fw-bold" style="font-family: 'Calisto MT', serif; font-size: large;">{{ $car->price_daily }} <span>AED</span></h6>
                                    </div>

                                    <div class="col-4">
                                        <h4 class="text-center text-white" style="font-family: 'Calisto MT', serif; font-size: medium;">Weekly</h4>
                                        <h6 class="text-center text-white fw-bold" style="font-family: 'Calisto MT', serif; font-size: large;">{{ $car->price_weekly }} <span>AED</span></h6>
                                    </div>

                                    <div class="col-4">
                                        <h4 class="text-center text-white" style="font-family: 'Calisto MT', serif; font-size: medium;">Monthly</h4>
                                        <h6 class="text-center text-white fw-bold" style="font-family: 'Calisto MT', serif; font-size: large;">{{ $car->price_monthly }} <span>AED</span></h6>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="mb-3 d-flex justify-content-start">
                                                <button class="btn text-center my-2" style="background-color: #949494; color: white; font-family: 'Calisto MT', serif;" data-bs-toggle="modal" data-bs-target="#bookingModal{{ $car->id }}">
                                                    Book Now
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-6 position-relative">
                                            <div class="mb-3">
                                                <!-- WhatsApp Icon as a clickable link -->
                                                <a href="https://wa.me/971542700030?text=Hi!%20I%20am%20interested%20in%20this%20car.%20Here%20is%20the%20link%20to%20the%20car:%20{{ route('cars.show', ['id' => $car->id]) }}%20and%20here%20is%20the%20image%20of%20the%20car:%20{{ asset('path/to/car-image.jpg') }}" target="_blank" class="position-absolute bottom-0 end-0 mb-4 me-3">
                                                    <i class="fab fa-whatsapp" style="font-size: 40px; color: #25D366;"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Booking Modal -->
                        <div class="modal fade" id="bookingModal{{ $car->id }}" tabindex="-1" aria-labelledby="bookingModalLabel{{ $car->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="bookingModalLabel{{ $car->id }}">Booking Form for {{ $car->car_name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="booking-box">
                                            <div class="booking-inner clearfix">
                                                <form method="post" action="{{ route('form.submit') }}" class="form1 contact__form clearfix" id="bookingForm">
                                                    @csrf
                                                    <input type="hidden" name="car_id" value="{{ $car->id }}">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="alert alert-success contact__msg" style="display: none" role="alert"> Your message was sent successfully. </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-12">
                                                            <label>Car Name</label>
                                                            <input name="carName" type="text" class="form-control" value="{{ $car->car_name . ' ' . $car->model . ' ' . $car->year }}" readonly>
                                                        </div>
                                                        <div class="col-lg-6 col-md-12">
                                                            <label>Car ID</label>
                                                            <input type="text" class="form-control" value="{{ $car->id }}" name="carID" readonly>
                                                        </div>
                                                        <input type="hidden" name="plate_number" value="{{ $car->plate_number }}">
                                                        <input type="hidden" name="price_daily" value="{{ $car->price_daily }}">

                                                        <div class="col-lg-6 col-md-12">
                                                            <input name="name" type="text" placeholder="Full Name *" required>
                                                        </div>
                                                        <div class="col-lg-6 col-md-12">
                                                            <input name="email" type="email" placeholder="Email *" required>
                                                        </div>
                                                        <div class="col-lg-6 col-md-12">
                                                            <input name="phone" type="text" placeholder="Phone *" required>
                                                        </div>
                                                        <div class="col-lg-6 col-md-12">
                                                            <div class="select1_wrapper">
                                                                <label>Pick Up Location</label>
                                                                <div class="select1_inner">
                                                                    <select name="pickup_city" class="select2 select" style="width: 100%" required>
                                                                        <option value="" disabled selected>Select a City</option>
                                                                        <option value="Dubai">Dubai</option>
                                                                        <option value="Sharjah">Sharjah</option>
                                                                        <option value="Alain">Alain</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-12">
                                                            <div class="input1_wrapper">
                                                                <label>Pick Up Date and Time</label>
                                                                <div class="input1_inner">
                                                                    <input id="pickup_date" name="pickup_date" type="text" class="form-control input" placeholder="Pick Up Date and Time" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6 col-md-12">
                                                            <div class="input1_wrapper">
                                                                <label>Return Up Date and Time</label>
                                                                <div class="input1_inner">
                                                                    <input id="return_date" name="return_date" type="text" class="form-control input" placeholder="Return Up Date and Time" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12">
                                                            <label>Additional Comments</label>
                                                            <textarea class="form-control" name="message" rows="6" placeholder="Leave a Message"></textarea>
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <div class="submitBtn">
                                                                <button type="submit" class="btn btn-block submit text-center" style="background-color: #5D5D5D;">Send Inquiry</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal -->
                    @endif
                @endforeach
            </div>
        </section>



<!-- New Section with Centered Title and Clickable Labels -->
<section class="py-5 mt-5">
    <div class="container text-center">
        <!-- Section Title -->
        <h2 id="line-three" class="display-4 mb-4" style="font-family: 'Calisto MT', serif; color:#0F2026;">RENT ANY CAR YOU LIKE</h2>

        <!-- Tab Navigation for Smaller Screens -->
        <ul class="nav nav-pills justify-content-center mb-4" id="carTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="luxury-tab" data-bs-toggle="pill" href="#luxury" role="tab" aria-controls="luxury" aria-selected="true">
                    LUXURY
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="premium-tab" data-bs-toggle="pill" href="#premium" role="tab" aria-controls="premium" aria-selected="false">
                    PREMIUM
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="economy-tab" data-bs-toggle="pill" href="#economy" role="tab" aria-controls="economy" aria-selected="false">
                    ECONOMY
                </a>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="carTabsContent">
            <!-- Luxury Tab -->
            <div class="tab-pane fade show active" id="luxury" role="tabpanel" aria-labelledby="luxury-tab">
                <a href="{{ route('luxury.page') }}" class="d-block text-decoration-none text-dark">
                    <div class="d-flex align-items-center justify-content-center position-relative rounded mb-4">
                        <img src="{{asset('front/img/luxurycar.jpeg')}}" alt="Luxury Car" class="img-fluid rounded w-100">
                        <div class="overlay position-absolute w-100 h-100 bg-dark opacity-50 rounded"></div>
                        <div class="text-center position-absolute">
                            <h4 class="text-white" style="font-size: 2.5rem; font-weight: bold; text-transform: uppercase;">LUXURY</h4>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Premium Tab -->
            <div class="tab-pane fade" id="premium" role="tabpanel" aria-labelledby="premium-tab">
                <a href="{{ route('premium.page') }}" class="d-block text-decoration-none text-dark">
                    <div class="d-flex align-items-center justify-content-center position-relative rounded mb-4">
                        <img src="{{ asset('front/img/premium.png') }}" alt="Premium Car" class="img-fluid rounded w-100">
                        <div class="overlay position-absolute w-100 h-100 bg-dark opacity-50 rounded"></div>
                        <div class="text-center position-absolute">
                            <h4 class="text-white" style="font-size: 2.5rem; font-weight: bold; text-transform: uppercase;">PREMIUM</h4>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Economy Tab -->
            <div class="tab-pane fade" id="economy" role="tabpanel" aria-labelledby="economy-tab">
                <a href="{{ route('economy.page') }}" class="d-block text-decoration-none text-dark">
                    <div class="d-flex align-items-center justify-content-center position-relative rounded mb-4">
                        <img src="{{ asset('front/img/economy.jpg') }}" alt="Economy Car" class="img-fluid rounded w-100">
                        <div class="overlay position-absolute w-100 h-100 bg-dark opacity-50 rounded"></div>
                        <div class="text-center position-absolute">
                            <h4 class="text-white" style="font-size: 2.5rem; font-weight: bold; text-transform: uppercase;">ECONOMY</h4>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>




<!--Instagram-->
<section class="instagram-posts-section py-5 my-5">
            <div class="container text-center">
            <div class="lightning">
                <div class="noisy">
                    Instagram
                </div>
                <div class="noisy">
                    Posts
                </div>
            </div>        
<div class="row">
            <!-- Instagram Post 1 -->
            <div class="col-md-4 mb-4">
                <blockquote class="instagram-media" data-instgrm data-instgrm-permalink="https://www.instagram.com/p/DBwY8JEtjN3/?utm_source=ig_embed&amp;utm_campaign=loading" data-instgrm-version="14" style="background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:540px; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);">
                    <div style="padding:4px;"> 
                        <a href="https://www.instagram.com/p/DBwY8JEtjN3/?utm_source=ig_embed&amp;utm_campaign=loading" style="background:#FFFFFF; line-height:0; padding:0 0; text-align:center; text-decoration:none; width:100%;" target="_blank"> 
                            <div style="display: flex; flex-direction: row; align-items: center;">
                                <div style="background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 40px; margin-right: 14px; width: 40px;"></div>
                                <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center;">
                                    <div style="background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 100px;"></div>
                                    <div style="background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 60px;"></div>
                                </div>
                            </div>
                            <div style="padding: 19% 0;"></div>
                            <div style="display:block; height:50px; margin:0 auto 12px; width:50px;">
                                <svg width="50px" height="50px" viewBox="0 0 60 60" version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g transform="translate(-511.000000, -20.000000)" fill="#000000">
                                            <g><path d="M556.869,30.41 C554.814,30.41 553.148,32.076 553.148,34.131 C553.148,36.186 554.814,37.852 556.869,37.852 C558.924,37.852 560.59,36.186 560.59,34.131 C560.59,32.076 558.924,30.41 556.869,30.41 M541,60.657 C535.114,60.657 530.342,55.887 530.342,50 C530.342,44.114 535.114,39.342 541,39.342 C546.887,39.342 551.658,44.114 551.658,50 C551.658,55.887 546.887,60.657 541,60.657 M541,33.886 C532.1,33.886 524.886,41.1 524.886,50 C524.886,58.899 532.1,66.113 541,66.113 C549.9,66.113 557.115,58.899 557.115,50 C557.115,41.1 549.9,33.886 541,33.886 M565.378,62.101 C565.244,65.022 564.756,66.606 564.346,67.663 C563.803,69.06 563.154,70.057 562.106,71.106 C561.058,72.155 560.06,72.803 558.662,73.347 C557.607,73.757 556.021,74.244 553.102,74.378 C549.944,74.521 548.997,74.552 541,74.552 C533.003,74.552 532.056,74.521 528.898,74.378 C525.979,74.244 524.393,73.757 523.338,73.347 C521.94,72.803 520.942,72.155 519.894,71.106 C518.846,70.057 518.197,69.06 517.654,67.663 C517.244,66.606 516.755,65.022 516.623,62.101 C516.479,58.943 516.448,57.996 516.448,50 C516.448,42.003 516.479,41.056 516.623,37.899 C516.755,34.978 517.244,33.391 517.654,32.338 C518.197,30.938 518.846,29.942 519.894,28.894 C520.942,27.846 521.94,27.196 523.338,26.654 C524.393,26.244 525.979,25.756 528.898,25.623 C532.057,25.479 533.004,25.448 541,25.448 C548.997,25.448 549.943,25.479 553.102,25.623 C556.021,25.756 557.607,26.244 558.662,26.654 C560.06,27.196 561.058,27.846 562.106,28.894 C563.154,29.942 563.803,30.938 564.346,32.338 C564.756,33.391 565.244,34.978 565.378,37.899 C565.522,41.056 565.552,42.003 565.552,50 C565.552,57.996 565.522,58.943 565.378,62.101 M570.82,37.631 C570.674,34.438 570.167,32.258 569.425,30.349 C568.659,28.377 567.633,26.702 565.965,25.035 C564.297,23.368 562.623,22.342 560.652,21.575 C558.743,20.834 556.562,20.326 553.369,20.18 C550.169,20.033 549.148,20 541,20 C532.853,20 531.831,20.033 528.631,20.18 C525.438,20.326 523.257,20.834 521.349,21.575 C519.376,22.342 517.703,23.368 516.035,25.035 C514.368,26.702 513.342,28.377 512.574,30.349 C511.834,32.258 511.326,34.438 511.181,37.631 C511.035,40.831 511,41.851 511,50 C511,58.147 511.035,59.17 511.181,62.369 C511.326,65.562 511.834,67.743 512.574,69.651 C513.342,71.625 514.368,73.296 516.035,74.965 C517.703,76.634 519.376,77.658 521.349,78.425 C523.257,79.167 525.438,79.673 528.631,79.82 C531.831,79.965 532.853,80.001 541,80.001 C549.148,80.001 550.169,79.965 553.369,79.82 C556.562,79.673 558.743,79.167 560.652,78.425 C562.623,77.658 564.297,76.634 565.965,74.965 C567.633,73.296 568.659,71.625 569.425,69.651 C570.167,67.743 570.674,65.562 570.82,62.369 C570.966,59.17 571,58.147 571,50 C571,41.851 570.966,40.831 570.82,37.631"></path></g></g></g></svg>
                            </div>
                            <div style="padding-top: 8px;"> 
                                <div style="color:#3897f0; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:550; line-height:18px;">View this post on Instagram</div>
                            </div>

                        </a>
                    </div>
                </blockquote>
            </div>

            <!-- Instagram Post 2 -->
            <div class="col-md-4 mb-4">
            <blockquote class="instagram-media" data-instgrm data-instgrm-permalink="https://www.instagram.com/p/DBwYfiNtFKP/?utm_source=ig_embed&amp;utm_campaign=loading" data-instgrm-version="14" style=" background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:540px; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);">
                <div style="padding:16px;"> 
                    <a href="https://www.instagram.com/p/DBwYfiNtFKP/?utm_source=ig_embed&amp;utm_campaign=loading" style="background:#FFFFFF; line-height:0; padding:0 0; text-align:center; text-decoration:none; width:100%;" target="_blank"> 
                    <div style="display: flex; flex-direction: row; align-items: center;"> 
                        <div style="background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 40px; margin-right: 14px; width: 40px;"></div> 
                        <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center;"> 
                        <div style="background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 100px;"></div> 
                        <div style="background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 60px;"></div>
                        </div>
                    </div>
                    <div style="padding: 19% 0;"></div> 
                    <div style="display:block; height:50px; margin:0 auto 12px; width:50px;">
                        <svg width="50px" height="50px" viewBox="0 0 60 60" version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g transform="translate(-511.000000, -20.000000)" fill="#000000">
                            <g>
                                <path d="M556.869,30.41 C554.814,30.41 553.148,32.076 553.148,34.131 C553.148,36.186 554.814,37.852 556.869,37.852 C558.924,37.852 560.59,36.186 560.59,34.131 C560.59,32.076 558.924,30.41 556.869,30.41 M541,60.657 C535.114,60.657 530.342,55.887 530.342,50 C530.342,44.114 535.114,39.342 541,39.342 C546.887,39.342 551.658,44.114 551.658,50 C551.658,55.887 546.887,60.657 541,60.657 M541,33.886 C532.1,33.886 524.886,41.1 524.886,50 C524.886,58.899 532.1,66.113 541,66.113 C549.9,66.113 557.115,58.899 557.115,50 C557.115,41.1 549.9,33.886 541,33.886 M565.378,62.101 C565.244,65.022 564.756,66.606 564.346,67.663 C563.803,69.06 563.154,70.057 562.106,71.106 C561.058,72.155 560.06,72.803 558.662,73.347 C557.607,73.757 556.021,74.244 553.102,74.378 C549.944,74.521 548.997,74.552 541,74.552 C533.003,74.552 532.056,74.521 528.898,74.378 C525.979,74.244 524.393,73.757 523.338,73.347 C521.94,72.803 520.942,72.155 519.894,71.106 C518.846,70.057 518.197,69.06 517.654,67.663 C517.244,66.606 516.755,65.022 516.623,62.101 C516.479,58.943 516.448,57.996 516.448,50 C516.448,42.003 516.479,41.056 516.623,37.899 C516.755,34.978 517.244,33.391 517.654,32.338 C518.197,30.938 518.846,29.942 519.894,28.894 C520.942,27.846 521.94,27.196 523.338,26.654 C524.393,26.244 525.979,25.756 528.898,25.623 C532.057,25.479 533.004,25.448 541,25.448 C548.997,25.448 549.943,25.479 553.102,25.623 C556.021,25.756 557.607,26.244 558.662,26.654 C560.06,27.196 561.058,27.846 562.106,28.894 C563.154,29.942 563.803,30.938 564.346,32.338 C564.756,33.391 565.244,34.978 565.378,37.899 C565.522,41.056 565.552,42.003 565.552,50 C565.552,57.996 565.522,58.943 565.378,62.101 M570.82,37.631 C570.674,34.438 570.167,32.258 569.425,30.349 C568.659,28.377 567.633,26.702 565.965,25.035 C564.297,23.368 562.623,22.342 560.652,21.575 C558.743,20.834 556.562,20.326 553.369,20.18 C550.169,20.033 549.148,20 541,20 C532.853,20 531.831,20.033 528.631,20.18 C525.438,20.326 523.257,20.834 521.349,21.575 C519.376,22.342 517.703,23.368 516.035,25.035 C514.368,26.702 513.342,28.377 512.574,30.349 C511.834,32.258 511.326,34.438 511.181,37.631 C511.035,40.831 511,41.851 511,50 C511,58.147 511.035,59.17 511.181,62.369 C511.326,65.562 511.834,67.743 512.574,69.651 C513.342,71.625 514.368,73.296 516.035,74.965 C517.703,76.634 519.376,77.658 521.349,78.425 C523.257,79.167 525.438,79.673 528.631,79.82 C531.831,79.965 532.853,80.001 541,80.001 C549.148,80.001 550.169,79.965 553.369,79.82 C556.562,79.673 558.743,79.167 560.652,78.425 C562.623,77.658 564.297,76.634 565.965,74.965 C567.633,73.296 568.659,71.625 569.425,69.651 C570.167,67.743 570.674,65.562 570.82,62.369 C570.966,59.17 571,58.147 571,50 C571,41.851 570.966,40.831 570.82,37.631"></path>
                            </g>
                            </g>
                        </g>
                        </svg>
                    </div>
                    <div style="padding-top: 8px;"> 
                        <div style="color:#3897f0; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:550; line-height:18px;">View this post on Instagram</div>
                    </div>
                    </a>
                </div>
            </blockquote>
                </div>

                <!-- Instagram Post 3 -->
                <div class="col-md-4 mb-4">
                    <blockquote class="instagram-media" data-instgrm data-instgrm-permalink="https://www.instagram.com/p/DBwXCqbNO3i/?utm_source=ig_embed&amp;utm_campaign=loading" data-instgrm-version="14" style=" background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:540px; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);"><div style="padding:16px;"> <a href="https://www.instagram.com/p/DBwXCqbNO3i/?utm_source=ig_embed&amp;utm_campaign=loading" style=" background:#FFFFFF; line-height:0; padding:0 0; text-align:center; text-decoration:none; width:100%;" target="_blank"> <div style=" display: flex; flex-direction: row; align-items: center;"> <div style="background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 40px; margin-right: 14px; width: 40px;"></div> <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center;"> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 100px;"></div> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 60px;"></div></div></div><div style="padding: 19% 0;"></div> <div style="display:block; height:50px; margin:0 auto 12px; width:50px;"><svg width="50px" height="50px" viewBox="0 0 60 60" version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g transform="translate(-511.000000, -20.000000)" fill="#000000"><g><path d="M556.869,30.41 C554.814,30.41 553.148,32.076 553.148,34.131 C553.148,36.186 554.814,37.852 556.869,37.852 C558.924,37.852 560.59,36.186 560.59,34.131 C560.59,32.076 558.924,30.41 556.869,30.41 M541,60.657 C535.114,60.657 530.342,55.887 530.342,50 C530.342,44.114 535.114,39.342 541,39.342 C546.887,39.342 551.658,44.114 551.658,50 C551.658,55.887 546.887,60.657 541,60.657 M541,33.886 C532.1,33.886 524.886,41.1 524.886,50 C524.886,58.899 532.1,66.113 541,66.113 C549.9,66.113 557.115,58.899 557.115,50 C557.115,41.1 549.9,33.886 541,33.886 M565.378,62.101 C565.244,65.022 564.756,66.606 564.346,67.663 C563.803,69.06 563.154,70.057 562.106,71.106 C561.058,72.155 560.06,72.803 558.662,73.347 C557.607,73.757 556.021,74.244 553.102,74.378 C549.944,74.521 548.997,74.552 541,74.552 C533.003,74.552 532.056,74.521 528.898,74.378 C525.979,74.244 524.393,73.757 523.338,73.347 C521.94,72.803 520.942,72.155 519.894,71.106 C518.846,70.057 518.197,69.06 517.654,67.663 C517.244,66.606 516.755,65.022 516.623,62.101 C516.479,58.943 516.448,57.996 516.448,50 C516.448,42.003 516.479,41.056 516.623,37.899 C516.755,34.978 517.244,33.391 517.654,32.338 C518.197,30.938 518.846,29.942 519.894,28.894 C520.942,27.846 521.94,27.196 523.338,26.654 C524.393,26.244 525.979,25.756 528.898,25.623 C532.057,25.479 533.004,25.448 541,25.448 C548.997,25.448 549.943,25.479 553.102,25.623 C556.021,25.756 557.607,26.244 558.662,26.654 C560.06,27.196 561.058,27.846 562.106,28.894 C563.154,29.942 563.803,30.938 564.346,32.338 C564.756,33.391 565.244,34.978 565.378,37.899 C565.522,41.056 565.552,42.003 565.552,50 C565.552,57.996 565.522,58.943 565.378,62.101 M570.82,37.631 C570.674,34.438 570.167,32.258 569.425,30.349 C568.659,28.377 567.633,26.702 565.965,25.035 C564.297,23.368 562.623,22.342 560.652,21.575 C558.743,20.834 556.562,20.326 553.369,20.18 C550.169,20.033 549.148,20 541,20 C532.853,20 531.831,20.033 528.631,20.18 C525.438,20.326 523.257,20.834 521.349,21.575 C519.376,22.342 517.703,23.368 516.035,25.035 C514.368,26.702 513.342,28.377 512.574,30.349 C511.834,32.258 511.326,34.438 511.181,37.631 C511.035,40.831 511,41.851 511,50 C511,58.147 511.035,59.17 511.181,62.369 C511.326,65.562 511.834,67.743 512.574,69.651 C513.342,71.625 514.368,73.296 516.035,74.965 C517.703,76.634 519.376,77.658 521.349,78.425 C523.257,79.167 525.438,79.673 528.631,79.82 C531.831,79.965 532.853,80.001 541,80.001 C549.148,80.001 550.169,79.965 553.369,79.82 C556.562,79.673 558.743,79.167 560.652,78.425 C562.623,77.658 564.297,76.634 565.965,74.965 C567.633,73.296 568.659,71.625 569.425,69.651 C570.167,67.743 570.674,65.562 570.82,62.369 C570.966,59.17 571,58.147 571,50 C571,41.851 570.966,40.831 570.82,37.631"></path></g></g></g></svg></div><div style="padding-top: 8px;"> <div style=" color:#3897f0; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:550; line-height:18px;">View this post on Instagram</div></div><div style="padding: 12.5% 0;"></div> <div style="display: flex; flex-direction: row; margin-bottom: 14px; align-items: center;"><div> <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(0px) translateY(7px);"></div> <div style="background-color: #F4F4F4; height: 12.5px; transform: rotate(-45deg) translateX(3px) translateY(1px); width: 12.5px; flex-grow: 0; margin-right: 14px; margin-left: 2px;"></div> <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(9px) translateY(-18px);"></div></div><div style="margin-left: 8px;"> <div style=" background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 20px; width: 20px;"></div> <div style=" width: 0; height: 0; border-top: 2px solid transparent; border-left: 6px solid #f4f4f4; border-bottom: 2px solid transparent; transform: translateX(16px) translateY(-4px) rotate(30deg)"></div></div><div style="margin-left: auto;"> <div style=" width: 0px; border-top: 8px solid #F4F4F4; border-right: 8px solid transparent; transform: translateY(16px);"></div> <div style=" background-color: #F4F4F4; flex-grow: 0; height: 12px; width: 16px; transform: translateY(-4px);"></div> <div style=" width: 0; height: 0; border-top: 8px solid #F4F4F4; border-left: 8px solid transparent; transform: translateY(-4px) translateX(8px);"></div></div></div> <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center; margin-bottom: 24px;"> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 224px;"></div> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 144px;"></div></div></a><p style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; line-height:17px; margin-bottom:0; margin-top:8px; overflow:hidden; padding:8px 0 7px; text-align:center; text-overflow:ellipsis; white-space:nowrap;"><a href="https://www.instagram.com/p/DBwXCqbNO3i/?utm_source=ig_embed&amp;utm_campaign=loading" style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:normal; line-height:17px; text-decoration:none;" target="_blank">A post shared by Luxuria Rent car | UAE (@luxuria_uae)</a></p></div></blockquote>
                </div>
            </div>
        </div>
</section>





<section class="newsletter-section bg-light" style="min-height: 500px; position: relative; background-image: url('front/img/newss.jpg'); background-size: cover; background-position: center center; display: flex; justify-content: center; align-items: center;">
   <!-- Dark overlay -->
   <div class="overlay"></div>

   <div class="container text-center position-relative">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2 class="display-4 mb-4" style="font-family: 'Calisto MT', serif; color: white; font-size: 50px;">Subscribe To Our Newsletter</h2>
                
                <form action="#" method="post">
                    @csrf
                    <div class="input-group input-group-lg">
                        <input type="email" class="form-control" name="email" placeholder="Enter your email" required>


                    </div>
                    <button class="btn btn-primary" type="submit">
                                <i class="fas fa-paper-plane"></i> Subscribe
                            </button>


                </form>
                
                <!-- Optional success or error messages -->
                @if(session('success'))
                    <div class="alert alert-success mt-4">
                        {{ session('success') }}
                    </div>
                @elseif(session('error'))
                    <div class="alert alert-danger mt-4">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection
