<?

function _rec($rec){
  if($rec>5){
    return "<img src='http://localhost:8080/assets/img/icons/full_star.png' width='15px;'>".
            "<img src='http://localhost:8080/assets/img/icons/full_star.png' width='15px;'>".
            "<img src='http://localhost:8080/assets/img/icons/full_star.png' width='15px;'>".
            "<img src='http://localhost:8080/assets/img/icons/full_star.png' width='15px;'>".
            "<img src='http://localhost:8080/assets/img/icons/full_star.png' width='15px;'>";
  }else if($rec >= 4.5){
    return "<img src='http://localhost:8080/assets/img/icons/full_star.png' width='15px;'>".
            "<img src='http://localhost:8080/assets/img/icons/full_star.png' width='15px;'>".
            "<img src='http://localhost:8080/assets/img/icons/full_star.png' width='15px;'>".
            "<img src='http://localhost:8080/assets/img/icons/full_star.png' width='15px;'>".
            "<img src='http://localhost:8080/assets/img/icons/half_star.png' width='15px;'>";
  }else if($rec >= 4){
    return "<img src='http://localhost:8080/assets/img/icons/full_star.png' width='15px;'>".
            "<img src='http://localhost:8080/assets/img/icons/full_star.png' width='15px;'>".
            "<img src='http://localhost:8080/assets/img/icons/full_star.png' width='15px;'>".
            "<img src='http://localhost:8080/assets/img/icons/full_star.png' width='15px;'>".
            "<img src='http://localhost:8080/assets/img/icons/empty_star.png' width='15px;'>";
  }else if($rec >= 3.5){
    return "<img src='http://localhost:8080/assets/img/icons/full_star.png' width='15px;'>".
            "<img src='http://localhost:8080/assets/img/icons/full_star.png' width='15px;'>".
            "<img src='http://localhost:8080/assets/img/icons/full_star.png' width='15px;'>".
            "<img src='http://localhost:8080/assets/img/icons/half_star.png' width='15px;'>".
            "<img src='http://localhost:8080/assets/img/icons/empty_star.png' width='15px;'>";
  }else if($rec >= 3){
    return "<img src='http://localhost:8080/assets/img/icons/full_star.png' width='15px;'>".
            "<img src='http://localhost:8080/assets/img/icons/full_star.png' width='15px;'>".
            "<img src='http://localhost:8080/assets/img/icons/full_star.png' width='15px;'>".
            "<img src='http://localhost:8080/assets/img/icons/empty_star.png' width='15px;'>".
            "<img src='http://localhost:8080/assets/img/icons/empty_star.png' width='15px;'>";
  }else if($rec >= 2.5){
    return "<img src='http://localhost:8080/assets/img/icons/full_star.png' width='15px;'>".
            "<img src='http://localhost:8080/assets/img/icons/full_star.png' width='15px;'>".
            "<img src='http://localhost:8080/assets/img/icons/half_star.png' width='15px;'>".
            "<img src='http://localhost:8080/assets/img/icons/empty_star.png' width='15px;'>".
            "<img src='http://localhost:8080/assets/img/icons/empty_star.png' width='15px;'>";
  }else if($rec >= 2){
    return "<img src='http://localhost:8080/assets/img/icons/full_star.png' width='15px;'>".
            "<img src='http://localhost:8080/assets/img/icons/full_star.png' width='15px;'>".
            "<img src='http://localhost:8080/assets/img/icons/empty_star.png' width='15px;'>".
            "<img src='http://localhost:8080/assets/img/icons/empty_star.png' width='15px;'>".
            "<img src='http://localhost:8080/assets/img/icons/empty_star.png' width='15px;'>";
  }else if($rec >= 1.5){
    return "<img src='http://localhost:8080/assets/img/icons/full_star.png' width='15px;'>".
            "<img src='http://localhost:8080/assets/img/icons/half_star.png' width='15px;'>".
            "<img src='http://localhost:8080/assets/img/icons/empty_star.png' width='15px;'>".
            "<img src='http://localhost:8080/assets/img/icons/empty_star.png' width='15px;'>".
            "<img src='http://localhost:8080/assets/img/icons/empty_star.png' width='15px;'>";
  }else if($rec >= 1){
    return "<img src='http://localhost:8080/assets/img/icons/full_star.png' width='15px;'>".
            "<img src='http://localhost:8080/assets/img/icons/empty_star.png' width='15px;'>".
            "<img src='http://localhost:8080/assets/img/icons/empty_star.png' width='15px;'>".
            "<img src='http://localhost:8080/assets/img/icons/empty_star.png' width='15px;'>".
            "<img src='http://localhost:8080/assets/img/icons/empty_star.png' width='15px;'>";
  }else if($rec >= 0.5){
    return "<img src='http://localhost:8080/assets/img/icons/half_star.png' width='15px;'>".
            "<img src='http://localhost:8080/assets/img/icons/empty_star.png' width='15px;'>".
            "<img src='http://localhost:8080/assets/img/icons/empty_star.png' width='15px;'>".
            "<img src='http://localhost:8080/assets/img/icons/empty_star.png' width='15px;'>".
            "<img src='http://localhost:8080/assets/img/icons/empty_star.png' width='15px;'>";
  }
}
